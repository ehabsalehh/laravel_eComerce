<?php

namespace App\Http\Controllers\Customer;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\CategoryResource;
use App\Http\Traits\Category\GetActiveCategoryTrait;
use App\Http\Traits\Category\GetPopularCtegoryTrait;
use App\Http\Traits\Product\GetActiveProductByCategoryTrait;

class FrontendController extends Controller
{
    use GetPopularCtegoryTrait,
    GetActiveProductByCategoryTrait,
    GetActiveCategoryTrait
    ;

    // fetched popular categories
    public function index(){
        $active_products= Product::activeProduct();
        $active_categories =Category::activeCategory();
        $data =['active_products'=>$active_products,'active_categories',$active_categories]; 
        return response()->json(['data'=>$data]);
    }

    public function activeCategory(){
        return CategoryResource::collection($this->getActiveCategory()->get());
    }
    public function activeProductByCategory($category_id){
        return ProductResource::collection($this->getActiveProductByCategory($category_id));   
    }
    
    public function viewProduct($product_slug){
            $viewproduct = Product::Slug($product_slug)->ProductWith()->get();
            return  ProductResource::collection($viewproduct);
    }
    private function explodeGetRequest($request):array
    {
        return explode(',',$request);
    }
    public function productGrids(){
        $request = $_GET['category']??$_GET['subCategory']??$_GET['brand']??$_GET['supplier'];
        $slug = $this->explodeGetRequest($request);
        $products=Product::query()->when(isset($_GET['category']),function($query)use($slug){
                $categoryIds= Category::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
                return $query->whereIn('category_id',$categoryIds)->where('status','active')->productWith();
        })->paginate(10);

        $products=Product::query()->when(isset($_GET['subCategory']),function($query)use($slug){
            $childcategoryIds= Category::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            return $query->whereIn('child_category_id',$childcategoryIds)->where('status','active')->productWith();
        })->paginate(10);

        $products=Product::query()->when(isset($_GET['brand']),function($query)use($slug){
            $brandIds= Brand::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            return $query->whereIn('brand_id',$brandIds)->where('status','active')->productWith();
        })->paginate(10);

        $products=Product::query()->when(isset($_GET['supplier']),function($query)use($slug){
            $SupplierIds= Supplier::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            return $query->whereIn('supplier_id',$SupplierIds)->where('status','active')->productWith();
        })->paginate(10);
        return  ProductResource::collection($products);
    }

    public function sortProductByName(string $sort){
       $product= Product::where('status','active')->orderBy('name',$sort)
       ->productWith()
       ->paginate(10);
       return  ProductResource::collection($product);
        
    }
    public function sortProductByPrice(string $sort){
        $product= Product::where('status','active')->orderBy('price',$sort)
        ->productWith()
        ->paginate(10);
        return  ProductResource::collection($product);        
    }
    
    public function productByRangePrice(){
        $product= Product::query()->when(isset($_GET['price']),function($query){
            $price = $this->explodeGetRequest($_GET['price']);
            return $query->where('status','active')->whereBetween('price',$price)->productWith();
        })->paginate(10);
        return  ProductResource::collection($product); ;
    }  
    public function bestSeller($category){
        return DB::table('products')
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->where('products.category_id',$category)
            ->orWhere('products.child_category_id',$category)
            ->groupBy('order_items.product_id','products.name')
            ->orderByDesc('bestSeller')
            ->select('products.name as product_name',DB::raw('count(order_items.product_id) as bestSeller'))
            ->limit(10)
            ->get();

    }
    public function productSearch(Request $request){
        $productSearch= Product::orWhere('name','like','%'.$request->search.'%')
                 ->orWhere('slug','like','%'.$request->search.'%')
                 ->orWhere('price','like','%'.$request->search.'%')
                 ->orWhere('size','like','%'.$request->search.'%')
                 ->OrderByDesc('id')
                 ->productWith()
                 ->paginate(10);
         return ProductResource::collection($productSearch);
     }
    public function newArrivals($days){
            $product= Product::where('status','active')
                ->where( 'created_at', '<', Carbon::now()->subDays($days))
                ->orderByDesc('id')->limit(10)
                ->get();
        return ProductResource::collection($product);

    }
    public function getAllcategory(){
        return  Category::with('parent_info')->paginate(10);
    }
    public function getAllProduct(){
        $product =Product::ProductWith()->get();
        return ProductResource::collection($product);
    }
    public function productByCategory(Request $request){
        $product =Category::where('slug',$request->slug)->with(['products','sub_products'])->paginate(10);
        return CategoryResource::collection($product);
    }
    public function productDetails(Request $request ){
        return $getProduct= Product::where('slug',$request->slug)->ProductWith()->get();
       return new  ProductResource($getProduct);

    }
    public function ProductBrand(Request $request){
        return Brand::where('slug',$request->slug)->with('products')->limit(10)->get();
    }


    
}

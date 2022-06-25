<?php

namespace App\Http\Controllers\Customer;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\CategoryResource;
use App\Http\Traits\Category\GetActiveCategoryTrait;
use App\Http\Traits\Category\GetPopularCtegoryTrait;
use App\Http\Traits\Product\GetActiveProductByCategoryTrait;
use App\Models\Supplier;

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
        $data =['popular_products'=>$active_products,'popular_categories',$active_categories]; 
        return response()->json(['data'=>$data]);
    }

    public function activeCategory(){
        return CategoryResource::collection($this->getActiveCategory()->get());
    }
    public function activeProductByCategory($category_id){
        return ProductResource::collection($this->getActiveProductByCategory($category_id));   
    }
    
    public function viewProduct($product_slug){
            $viewproduct = Product::Slug($product_slug)->with('rating','review')->get();
            return  ProductResource::collection($viewproduct);
    }
    public function productGrids(){
        $products=Product::query();
        if(isset($_GET['category'])){
            $slug=explode(',',$_GET['category']);
            $categoryIds= Category::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            $products->whereIn('category_id',$categoryIds);
        }
        if(isset($_GET['subCategory'])){
            $slug=explode(',',$_GET['subCategory']);
            $childcategoryIds= Category::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            $products->whereIn('child_category_id',$childcategoryIds);
        }
        if(isset($_GET['brand'])){
            $slugs=explode(',',$_GET['brand']);
            $brandIds=Brand::select('id')->whereIn('slug',$slugs)->pluck('id')->toArray();
            $products->whereIn('brand_id',$brandIds);
        }
        if(isset($_GET['supplier'])){
            $name=explode(',',$_GET['supplier']);
            $SupplierIds= Supplier::select('id')->whereIn('name',$name)->pluck('id')->toArray();
            $products->whereIn('supplier_id',$SupplierIds);
        }
        $products=$products->where('status','active')->productWith()->paginate(10);
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
        if(isset($_GET['price'])){
            $price=explode('-',$_GET['price']);
             $product= Product::where('status','active')->whereBetween('price',$price)
             ->productWith()
             ->paginate(10);
             return  ProductResource::collection($product);        
        }
    }  
    public function bestSeller($category){
        return DB::table('products')
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->where('products.category_id',$category)
            ->groupBy('order_items.product_id','product_name')
            ->orderByDesc('bestSeller')
            ->select('products.name as product_name',DB::raw('count(order_items.product_id) as bestSeller'))
            ->limit(10)
            ->get();

    }
    public function newReleases(){
        return Product::where('status','active')->orderByDesc('id')->limit(10)->get();
    }
    public function getAllcategory(){
        return  Category::with('parent_info')->paginate(10);
    }
    public function getAllProduct(){
        $product =Product::with(['sub_category','category'])->get();
        return ProductResource::collection($product);
    }
    public function productByCategory(Request $request){
        $product =Category::where('slug',$request->slug)->with(['products'])->paginate();
        return CategoryResource::collection($product);
    }
    public function productBySubCategory(Request $request){
        $product =Category::where('slug',$request->slug)->with(['sub_products'])->paginate();
        return CategoryResource::collection($product);
    }
    public function productDetails(Request $request ){
        return $getProduct= Product::where('slug',$request->slug)->with(['category','sub_category','review','discount','rating'])->get();
       return new  ProductResource($getProduct);

    }
    public function productSearch(Request $request){
       $productSearch= Product::orWhere('name','like','%'.$request->search.'%')
                ->orWhere('slug','like','%'.$request->search.'%')
                ->orWhere('price','like','%'.$request->search.'%')
                ->orWhere('size','like','%'.$request->search.'%')
                ->OrderByDesc('id')
                ->with(['category','sub_category','review','discount','rating'])
                ->paginate(10);
        return ProductResource::collection($productSearch);
    }
    public function ProductBrand(Request $request){
        return Brand::where('slug',$request->slug)->with('products')->limit(10)->get();
    }


    
}

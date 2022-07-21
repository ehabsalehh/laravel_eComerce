<?php
namespace App\Http\Controllers\Frontend;
use App\Models\Admin\Setting;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Employee\Product\Brand;
use App\Http\Resources\ProductResource;
use App\Http\Resources\CategoryResource;
use App\Models\Employee\Product\Product;
use App\Models\Employee\Product\Category;
use App\Models\Employee\Product\Supplier;
use App\Services\Employee\Product\ActiveProductByCategory;

class FrontendController extends Controller
{
    private $activeProductByCategory;      
    public function index(){
        $activeProducts= Product::active()->get();
        $activeCategories =Category::active()->get();
        $data =['active-products'=>$activeProducts,'active-categories',$activeCategories]; 
        return response()->json(['data'=> $data]);
    }
    public function aboutUs(){
        return response()->json(['setting'=>Setting::get()]);
    }
    public function activeCategory(){
        return CategoryResource::collection(Category::active()->get());
    }
    public function getAllCategory(){
        return  Category::with('parent_info')->paginate(10);
    }
    public function activeProductByCategory(){
        $get = $_GET['category_id']??$_GET['child_category_id'];
        $product =  Product::byCategory($get)
            ->orWhere(function ($query)use($get) {
                $query->byChildCategory($get);
            })
            ->active()
            ->ProductWith()
            ->get();
        return ProductResource::collection($product);   
    }    
    public function viewProduct(){
        return Product::Slug($_GET['slug'])->ProductWith()->get();
        return ProductResource::collection(Product::Slug($_GET['slug'])->ProductWith()->get());
    }
    
    public function productSearch(){
        $productSearch= Product::Where('name','like','%'.$_GET['search'].'%')
                 ->orWhere('slug','like','%'.$_GET['search'].'%')
                 ->orWhere('price','like','%'.$_GET['search'].'%')
                 ->orWhere('size','like','%'.$_GET['search'].'%')
                 ->OrderByDesc('id')
                 ->productWith()
                 ->paginate(10);
         return ProductResource::collection($productSearch);
     } 
    public function bestSeller(){
        $get = $_GET['category']??$_GET['child-category'];
        return DB::table('products')
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->where('products.category_id',$get)
            ->orWhere('products.child_category_id',$get)
            ->groupBy('order_items.product_id','products.name')
            ->orderByDesc('bestSeller')
            ->select('products.name as product_name',
            DB::raw('count(order_items.product_id) as bestSeller'))
            ->limit(10)
            ->get();

    }
    public function newArrivals(){
        $product= Product::active()
            ->where( 'created_at', '<', now()->subDays($_GET['days']))
            ->orderByDesc('id')->limit(10)
            ->get();
        return ProductResource::collection($product);
    }
    public function getAllProduct(){
        $product =Product::ProductWith()->get();
        return ProductResource::collection($product);
    }
    public function productDetails(){
        $getProduct= Product::slug($_GET['slug'])
                            ->active()->ProductWith()->get();
        return new ProductResource($getProduct);
    }
    public function getProductByBrand(){
        return Brand::where('slug',$_GET['slug'])->with('products')->paginate(10);
    }

    public function productGrids(){       
        $productGrid = function($request,$model,$column){
            if(empty($_GET[$request])){return response()->json(['error'=>'empty Request']);}
            $slug=explode(',',$_GET[$request]);
            $model_ids=$model::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            return Product::whereIn($column,$model_ids)->active()->productWith()->paginate(10);
        };
        $category = $productGrid('category',Category::class,'category_id');
        $childCategory = $productGrid('childCategory',Category::class,'child_category_id');
        $brand = $productGrid('brand',Brand::class,'brand_id');
        $supplier = $productGrid('supplier',Supplier::class,'supplier_id');
        $response = $category??$childCategory??$brand??$supplier;
        return  ProductResource::collection($response);
    }

    public function sortProductByName(){
       $product= Product::active()
                ->orderBy('name',$_GET['sort'])
                ->productWith()
                ->paginate(10);
       return  ProductResource::collection($product);
        
    }
    public function sortProductByPrice(){
        $product= Product::active()
                        ->orderBy('price',$_GET['sort'])
                        ->productWith()
                        ->paginate(10);
        return  ProductResource::collection($product);        
    }
    public function productByRangePrice(){
        $product= Product::when(isset($_GET['range']),function($query){
            $price = explode('-',$_GET['range']);
            return $query->active()->whereBetween('price',$price)->productWith();
        })->paginate(10);
        return  ProductResource::collection($product); ;
    } 
    
}

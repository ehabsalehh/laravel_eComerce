<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\productCollection;
use App\Http\Traits\Product\GetPopularProductTrait;
use App\Http\Traits\Category\GetActiveCategoryTrait;
use App\Http\Traits\Category\GetPopularCtegoryTrait;
use App\Http\Traits\Product\GetProductByCategoryTrait;
use App\Http\Traits\Product\GetActiveProductByCategoryTrait;

class FrontendController extends Controller
{
    use GetPopularCtegoryTrait,
    GetPopularProductTrait,
    GetActiveProductByCategoryTrait,
    GetActiveCategoryTrait
    ;

    // fetched popular categories
    public function index(){
        $popular_products= $this->getPopularProduct();
        $popular_categories = $this->getPopularCtegory();
        $data =['popular_products'=>$popular_products,'popular_categories',$popular_categories]; 
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
    public function searchProduct($name){
        return  ProductResource::collection(Product::GetProductByName($name)->get());
        
    }

    
}

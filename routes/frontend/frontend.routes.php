<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontendController;
Route::prefix('viewer')->group(function () {
    Route::get('/home',[FrontendController::class,'index']);
    Route::get('/about-us',[FrontendController::class,'aboutUs']);
    Route::get("/active-Category",[FrontendController::class,'activeCategory']);
    Route::get('get-all-category',[FrontendController::class,'getAllCategory']);
    Route::get("/active-Product-By-Category",[FrontendController::class,'activeProductByCategory']);
    Route::get("/view-Product",[FrontendController::class,'viewProduct']);
    Route::get('product-search',[FrontendController::class,'productSearch']);
    Route::get('best-seller',[FrontendController::class,'bestSeller']);
    Route::get('new-arrivals',[FrontendController::class,'newArrivals']);
    Route::get('get-all-Product',[FrontendController::class,'getAllProduct']);
    Route::get('product-details',[FrontendController::class,'productDetails']);
    Route::get('Product-brand',[FrontendController::class,'getProductByBrand']);
    Route::get('product-grids',[FrontendController::class,'productGrids']);
    Route::get('sort-product-by-name',[FrontendController::class,'sortProductByName']);
    Route::get('sort-product-by-price',[FrontendController::class,'sortProductByPrice']);
    Route::get('product-by-range-price',[FrontendController::class,'productByRangePrice']);
});


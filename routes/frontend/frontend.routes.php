<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontendController;
Route::prefix('viewer')->group(function () {
    Route::controller(FrontendController::class)->group(function(){
        Route::get('/home','index');
        Route::get('/about-us','aboutUs');
        Route::get("/active-Category",'activeCategory');
        Route::get('get-all-category','getAllCategory');
        Route::get("/active-Product-By-Category",'activeProductByCategory');
        Route::get("/view-Product",'viewProduct');
        Route::get('product-search','productSearch');
        Route::get('best-seller','bestSeller');
        Route::get('new-arrivals','newArrivals');
        Route::get('get-all-Product','getAllProduct');
        Route::get('product-details','productDetails');
        Route::get('Product-brand','getProductByBrand');
        Route::get('product-grids','productGrids');
        Route::get('sort-product-by-name','sortProductByName');
        Route::get('sort-product-by-price','sortProductByPrice');
        Route::get('product-by-range-price','productByRangePrice');
    });
});


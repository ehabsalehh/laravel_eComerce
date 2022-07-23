<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employee\Product\ProductController;
Route::apiResources([
    'product' => Employee\Product\ProductController::class,
    'category' => Employee\Product\CategoryController::class,
    'supplier' => Employee\Product\SupplierController::class,
    'brand' =>   Employee\Product\BrandController::class,
    'location' => Employee\Product\LocationController::class,
]);
Route::post('product/{product}',[ProductController::class,'update']);
Route::resource('discount', Employee\Product\DiscountTController::class)->except([
    'create', 'index', 'edit', 
]);

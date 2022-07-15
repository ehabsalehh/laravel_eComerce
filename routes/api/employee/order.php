<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employee\Order\OrderController;
use App\Http\Controllers\Employee\Order\CouponController;
use App\Http\Controllers\Employee\Order\ShippingController;
use App\Http\Controllers\Employee\Order\DiscountTController;
Route::apiResources([
    'order' => OrderController::class,
    'shipping' => ShippingController::class,
    'coupon' => CouponController::class,
]);
Route::get('/order-items/{order}',[OrderController::class,'getOrderItems']);
Route::get('/order-status',[OrderController::class,'orderStatus']);
Route::post('/return-item',[OrderController::class,'returnItem']);
// discount
Route::resource('discount', DiscountTController::class)->except([
    'create', 'index', 'edit', 
]);
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employee\Order\OrderController;
Route::apiResources([
    'order' => OrderController::class,
    'shipping' => Employee\Order\ShippingController::class,
    'coupon' => Employee\Order\CouponController::class,
]);
Route::get('/order-items/{order}',[OrderController::class,'getOrderItems']);
Route::get('/order-status',[OrderController::class,'orderStatus']);
Route::post('/return-item',[OrderController::class,'returnItem']);

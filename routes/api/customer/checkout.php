<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\Checkout\CartController;
use App\Http\Controllers\Customer\Checkout\CheckoutController;

// cartController
Route::controller(CartController::class)->group(function(){
    Route::get('/index','index');
    Route::get('/CartCount','CartCount');
    Route::post('/addToCart','store');
    Route::post('/remove/{cart}','remove');
    Route::post('/deleteCart/{cart}','delete');
});

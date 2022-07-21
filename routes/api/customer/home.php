<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Customer\HomeController;
 Route::controller(HomeController::class)->group(function(){
    Route::get('/order-index','orderIndex');
    Route::get('/profile','profile');
    Route::get('/wishlist-count','wishlistCount');
    Route::get('/cart-count','CartCount');
    Route::post('/change-password','ChangeCustomerPassword');
    Route::post('/profile-update/{customer}','profileUpdate');
    Route::post('/order-delete/{order}','orderDelete');
    Route::post('/track-order','trackOrder');

});

Route::post('logout',[LogoutController::class,'logout']);
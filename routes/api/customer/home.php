<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\Home\HomeController;
 Route::controller(HomeController::class)->group(function(){
    Route::post('/change-password','ChangeCustomerPassword');
    Route::get('/profile','profile');
    Route::post('/profile-update/{customer}','profileUpdate');
    Route::get('/order-index','orderIndex');
    Route::post('/order-Delete/{order}','orderDelete');
    Route::post('/trackOrder','trackOrder');
});
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Employee\HomeController;
Route::controller(HomeController::class)->group(function(){
    Route::post("/profile/{employee}","profile"); 
    Route::post("/profile-update/{employee}","profileUpdate");
    Route::post("/Change-password","ChangeAdminPassword");
    Route::get('/send-discount-mail',"sendDiscountMail"); 

});
Route::post('logout',[LogoutController::class,'logout']);
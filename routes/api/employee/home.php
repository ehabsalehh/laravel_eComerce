<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Employee\HomeController;
use App\Http\Controllers\Admin\ChangePasswordController;

Route::controller(HomeController::class)->group(function(){
    Route::post("/profile/{employee}","profile"); 
    Route::post("/profile-update/{employee}","profileUpdate");
    Route::post("/Change-password","ChangeAdminPassword"); 

});
Route::post('logout',[LogoutController::class,'logout']);
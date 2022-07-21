<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\NotificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthAdminController;
use App\Http\Controllers\Auth\LogoutController;

Route::controller(HomeController::class)->group(function(){
    Route::post('/','index');
    Route::post('/change-password','ChangeAdminPassword');
    Route::post('/profile-update/{admin}','profileUpdate');
    Route::post('/setting-update','settingsUpdate');
    Route::get('/profile','profile');
    Route::get('/customerPieChart','customerPieChart');   
});
Route::controller(NotificationController::class)->group(function(){
    Route::get('/notification','index');
    Route::get('/notification/{id}','show');
    Route::Delete('/notification/{notification}','delete');
    Route::Delete('/notification','deleteAll');

});    
Route::post('logout',[LogoutController::class,'logout']);
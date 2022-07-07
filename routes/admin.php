<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\NotificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthAdminController;

Route::post('/registerAdmin', [AuthAdminController::class, 'register']);
Route::post("/loginAdmin",[AuthAdminController::class,"login"]);
Route::group(["middleware"=> ["auth:sanctum"],'prefix'=>'admin'],function(){
    // AdminController
    Route::get("/",[AdminController::class,"index"]);  
    Route::post("/settingsUpdate",[AdminController::class,"settingsUpdate"]); 
    Route::get("/customerPieChart",[AdminController::class,"customerPieChart"]);
    
    // Notification
    Route::get('/notifications',[NotificationController::class,'index']);
    Route::get('/markNotification/{id}',[NotificationController::class,'markNotification']);
    Route::Post('/deleteNotification/{notification}',[NotificationController::class,'delete']);
    Route::Post('/deleteAllNotification',[NotificationController::class,'deleteAll']);
    
    // logout
    Route::post("/logoutAdmin",[AuthAdminController::class,"logout"]);  

});

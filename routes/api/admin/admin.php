<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\NotificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthAdminController;

    // AdminController
    Route::get("/",[AdminController::class,"index"]);  
    Route::post("/settingsUpdate",[AdminController::class,"settingsUpdate"]); 
    Route::get("/customerPieChart",[AdminController::class,"customerPieChart"]);
    
    // Notification
    Route::get('/notification',[NotificationController::class,'index']);
    Route::get('/notification/{id}',[NotificationController::class,'show']);
    Route::Delete('/notification/{notification}',[NotificationController::class,'delete']);
    Route::Delete('/notification',[NotificationController::class,'deleteAll']);
    
    // logout
    Route::post("/logoutAdmin",[AuthAdminController::class,"logout"]);  



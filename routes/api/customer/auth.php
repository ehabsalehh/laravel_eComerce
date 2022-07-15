<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Route::post('/login', [LoginController::class, 'adminLogin']);
Route::prefix('customer')->group(function () {
    Route::post('/login', [LoginController::class, 'customerLogin']);
    Route::post('/register', [RegisterController::class, 'createCustomer']);

});
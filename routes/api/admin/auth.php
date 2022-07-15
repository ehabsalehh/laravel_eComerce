<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::prefix('admin')->group(function () {
    Route::post('/login', [LoginController::class, 'adminLogin']);
    Route::post('/register', [RegisterController::class, 'createAdmin']);

});
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::prefix('employee')->group(function () {
    Route::post('/login', [LoginController::class, 'employeeLogin']);
    Route::post('/register', [RegisterController::class, 'createEmployee']);

});
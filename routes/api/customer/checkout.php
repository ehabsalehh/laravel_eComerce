<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\Checkout\CartController;
Route::resource('cart', CartController::class)->except([
    'edit','create','show'
  ]);
Route::post('remove',[CartController::class,'remove']);

<?php

use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Customer\Checkout\CheckoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});
route::post("login-customer",[LoginController::class,'customerLogin'])->name('login-customer');
Route::group(['middleware' => ['auth']], function() {
    Route::get('viewCheckOut',[CheckoutController::class,'view'])->name('viewCheckOut');
    Route::post('/placeOrder',[CheckoutController::class,'placeOrder'])->name('placeOrder');
    Route::post('couponStore',[CheckoutController::class,'couponStore'])->name('couponStore');
    });
    

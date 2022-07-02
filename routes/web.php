<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\PayPalController;
use App\Http\Controllers\Auth\AuthCustomerController;
use App\Http\Controllers\Customer\CheckoutController;

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
// Auth::routes();

Route::get('/', function () {
    return view('login');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    
    Route::post('/placeOrder',[CheckoutController::class,'placeOrder'])->name('placeOrder');
    Route::post('couponStore',[CheckoutController::class,'coupon_Store'])->name('couponStore');
    route::get('/setSession',[CheckoutController::class,'setSession']);
    Route::get('create-transaction', [PayPalController::class, 'createTransaction'])->name('createTransaction');
    Route::get('process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
    Route::get('success-transaction', [PayPalControllerr::class, 'successTransaction'])->name('successTransaction');
    Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');
    
    });
    
    route::post("loginCustomer",[AuthCustomerController::class,'login'])->name('loginCustomer');
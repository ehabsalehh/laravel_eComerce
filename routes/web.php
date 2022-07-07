<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthCustomerController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Models\Customer;

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
    return view('auth.login');
});
// Route::get('/', function () {
//     // auth()->login(Customer::first());
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
route::post("loginCustomer",[AuthCustomerController::class,'login'])->name('loginCustomer');
Route::group(['middleware' => ['auth']], function() {
    Route::get('viewCheckOut',[CheckoutController::class,'view'])->name('viewCheckOut');
    Route::post('/placeOrder',[CheckoutController::class,'placeOrder'])->name('placeOrder');
    Route::post('couponStore',[CheckoutController::class,'couponStore'])->name('couponStore');
    route::get('/setSession',[CheckoutController::class,'setSession']);

    });
    

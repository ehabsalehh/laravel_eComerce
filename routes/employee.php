<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Auth\AuthAdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DiscountTController;
use App\Http\Controllers\Auth\AuthEmployeeController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Admin\ChangePasswordController;


Route::post('/registerEmployee', [AuthEmployeeController::class, 'register']); 
Route::post("/loginEmployee",[AuthEmployeeController::class,"login"]);
Route::group(["middleware"=> ["auth:sanctum"]],function(){

 // categories
//  Route::apiResource('category',CategoryController::class);
 route::get("/category",[CategoryController::class,'index']);
 route::post("/category",[CategoryController::class,'store']);
 route::get("/category/{category}",[CategoryController::class,'show']);
 route::post("/category/{category}",[CategoryController::class,'update']);
 route::delete("/category/{category}",[CategoryController::class,'destroy']);
 route::post("/Test",[CategoryController::class,'Test']);

// // Customers
// route::get('getAllCustomers',[CustomerController::class,'index']);
// // suppliers
route::get("/supplier",[SupplierController::class,'index']);
route::post("/supplier",[SupplierController::class,'store']);
route::get("/supplier/{supplier}",[SupplierController::class,'show']);
route::post("/supplier/{supplier}",[SupplierController::class,'update']);
route::delete("/supplier/{supplier}",[SupplierController::class,'destroy']);
// // shipping
route::get("/shipping",[ShippingController::class,'index']);
route::post("/shipping",[ShippingController::class,'store']);
route::get("/shipping/{shipping}",[ShippingController::class,'show']);
route::post("/shipping/{shipping}",[ShippingController::class,'update']);
route::delete("/shipping/{shipping}",[ShippingController::class,'destroy']);

// products
 route::get("/product",[ProductController::class,'index']);
 route::post("/product",[productController::class,'store']);
 route::get("/product/{product}",[productController::class,'show']);
 route::post("/product/{product}",[productController::class,'update']);
 route::delete("/product/{product}",[productController::class,'destroy']);
  // Orders
 route::get('orders',[OrderController::class,'index']);
 route::get('getOrderItems/{id}',[OrderController::class,'getOrderItems']);
 route::get('order_status/{status}',[OrderController::class,'order_status']);
 route::get('orders/{order}',[OrderController::class,'show']);
 route::post('update_order',[OrderController::class,'update']);
 route::post('Delete_order/{order}',[OrderController::class,'destroy']);
 route::post('/return_item',[OrderController::class,'return_item']);
 route::post('/decreaseQuantity',[OrderController::class,'decreaseQuantity']);


 
//  // Dashboard
//  route::get('Customers',[DashboardController::class,'Customers']); 
//  route::get('view_Customer/{Customer}',[DashboardController::class,'view_Customer']); 

 // Brand 
 route::post("brand",[BrandController::class,'store']);
 route::post("brand/{brand}",[BrandController::class,'update']);
 route::delete("brand/{brand}",[BrandController::class,'destroy']);

 //Location
 route::get("/location",[LocationController::class,'index']);
 route::post("/location",[LocationController::class,'store']);
 route::get("/location/{location}",[LocationController::class,'show']);
 route::post("/location/{location}",[LocationController::class,'update']);
 route::delete("/location/{location}",[LocationController::class,'destroy']);


//  Discount
route::post('discount',[DiscountTController::class,'store']);
route::post('discount/{discount}',[DiscountTController::class,'update']);

//cahngePassword
Route::group(['prefix'=>'employee'],function(){
    Route::Post('CahngePassword',[ChangePasswordController::class,'ChangeEmployeePassword']);     
});


//  Route::post("/logoutEmpolyee",[AuthEmployeeController::class,"logout"]);  


});

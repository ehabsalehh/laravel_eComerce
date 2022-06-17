<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Auth\AuthAdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AuthEmployeeController;


route::get('getAllCustomers',[CustomerController::class,'index']);
Route::post('/registerEmployee', [AuthEmployeeController::class, 'register']); 
Route::post("/loginEmployee",[AuthEmployeeController::class,"login"]);
Route::group(["middleware"=> ["auth:sanctum"]],function(){
 // categories
 route::get("/getAllcategory",[CategoryController::class,'index']);
 route::post("/storeCategory",[CategoryController::class,'store']);
 route::get("/category/{category}",[CategoryController::class,'show']);
 route::post("/update_category",[CategoryController::class,'update']);
 route::delete("/category/{category}",[CategoryController::class,'destroy']);
// Customers
route::get('getAllCustomers',[CustomerController::class,'index']);
// products
 route::get("/product",[ProductController::class,'index']);
 route::post("/product",[productController::class,'store']);
 route::get("/product/{product}",[productController::class,'show']);
 route::post("/update_product/{product:slug}",[productController::class,'update']);
 route::delete("/product/{product}",[productController::class,'destroy']);
 // Orders
 route::get('orders',[OrderController::class,'index']);
 route::get('getOrderItems/{id}',[OrderController::class,'getOrderItems']);
 route::get('order_status/{status}',[OrderController::class,'order_status']);
 route::get('orders/{order}',[OrderController::class,'show']);
 route::post('update_order',[OrderController::class,'update']);
 route::post('Delete_order/{order}',[OrderController::class,'destroy']);
 route::post('return_item',[OrderController::class,'return_item']);

 
 // Dashboard
 route::get('Customers',[DashboardController::class,'Customers']); 
 route::get('view_Customer/{Customer}',[DashboardController::class,'view_Customer']); 

 // Brand 
 route::post("addBrand",[BrandController::class,'store']);
 route::post("updateBrand",[BrandController::class,'update']);

 Route::post("/logoutEmpolyee",[AuthEmployeeController::class,"logout"]);    

});

<?php
use Illuminate\Support\Facades\Route;
require __DIR__.'/auth.php';
Route::group(["middleware"=> ["auth:sanctum"],'prefix'=>'admin','as' =>'admin.'],function(){
    require __DIR__.'/home.php';
    require __DIR__."/../employee/order.php";
    require __DIR__."/../employee/product.php";
});

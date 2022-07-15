<?php
use Illuminate\Support\Facades\Route;
require __DIR__.'/auth.php';

Route::group(["middleware"=> ["auth:sanctum"],'prefix'=>'customer','as' =>'customer.'],function(){
    require __DIR__.'/checkout.php';
    require __DIR__.'/home.php';
    require __DIR__.'/review.php';
});

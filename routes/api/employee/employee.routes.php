<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ChangePasswordController;
require __DIR__.'/auth.php';
Route::group(["middleware"=> ["auth:sanctum"],'prefix'=>'employee','as' =>'employee.'],function(){
    require __DIR__.'/home.php';
    require __DIR__.'/order.php';
    require __DIR__.'/product.php';
    
});

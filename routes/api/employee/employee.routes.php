<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ChangePasswordController;
require __DIR__.'/auth.php';
Route::group(["middleware"=> ["auth:sanctum,ability:employee"],'prefix'=>'employee','as' =>'employee.'],function(){
    require __DIR__.'/home.php';
    require __DIR__.'/order.php';
    require __DIR__.'/product.php';
    
});

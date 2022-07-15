<?php

use App\Http\Controllers\Admin\Customer\Home\TestController;
use Illuminate\Support\Facades\Route;
require __DIR__.'/auth.php';
Route::group(["middleware"=> ["auth:sanctum"],'prefix'=>'admin','as' =>'admin.'],function(){
    require __DIR__.'/admin.php';
});

<?php

use Illuminate\Support\Facades\Route;
require __DIR__.'/auth.php';
Route::group(["middleware"=> ["auth:sanctum,ability:admin"],'prefix'=>'admin','as' =>'admin.'],function(){
    require __DIR__.'/home.php';
});

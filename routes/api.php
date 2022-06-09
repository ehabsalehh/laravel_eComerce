<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\User\RatingController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\FrontendController;
use App\Http\Controllers\User\WishListController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\User\ReviewController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/register', [AuthController::class, 'register']);
Route::post("/login",[AuthController::class,"login"]);
Route::post("/login_user",[AuthController::class,"login"]);

// viewers
    route::get('viewerIndex',[FrontendController::class,'index']);
    route::get("/activeCategory",[FrontendController::class,'activeCategory']);
    route::get("/viewCategoryWithProducts/{id}",[FrontendController::class,'viewCategoryWithProducts']);
    route::get("/viewProduct/{product_slug}",[FrontendController::class,'viewProduct']);
    route::get("/activeProductByCategory/{categoryid}",[FrontendController::class,'activeProductByCategory']);
    Route::get('searchProduct/{search}',[FrontendController::class,'searchProduct']);
    // admin
Route::group(["middleware"=> ["auth:sanctum","isAdmin"]],function(){

// categories
    route::get("/category",[CategoryController::class,'index']);
    route::post("/category",[CategoryController::class,'store']);
    route::get("/category/{category}",[CategoryController::class,'show']);
    route::post("/update_category/{category:slug}",[CategoryController::class,'update']);
    route::delete("/category/{category}",[CategoryController::class,'destroy']);

// products
    route::get("/product",[productController::class,'index']);
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
    
    // Dashboard
    route::get('users',[DashboardController::class,'users']); 
    route::get('view_user/{user}',[DashboardController::class,'view_user']); 

    
    Route::post("/logout",[AuthController::class,"logout"]);
});

Route::group(["middleware"=> ["auth:sanctum"]],function(){
    // front end
    // cartController
    route::get('/index',[CartController::class,'index']);
    route::get('/viewCart',[CartController::class,'viewCart']);
    route::get('/CartCount',[CartController::class,'CartCount']);
    route::post('/addToCart',[CartController::class,'addToCart']);
    route::post('/updateCart',[CartController::class,'updateCart']);
    route::get('/totalPrice',[CartController::class,'totalPrice']);


    // checkOutController
    route::post('/placeOrder',[CheckoutController::class,'placeOrder']);

    // userController 
    route::get('/viewMyOrder',[UserController::class,'index']);
    

    route::post('/deleteCart/{cart}',[CartController::class,'deleteCart']);
    // WhishList
    Route::get('WishList',[WishListController::class,'index']);
    Route::get('wishList_show/{wishList}',[WishListController::class,'show']);
    Route::get('wishList_count',[WishListController::class,'wish_list_count']);
    Route::post('addWishList',[WishListController::class,'Add_to_wish_list']);
    Route::post('destroy_WishList/{wishList}',[WishListController::class,'deleteWishList']);
    // Rating
    Route::post('addRating',[RatingController::class,'addRating']);
    Route::get('testRating/{id}',[RatingController::class,'test']);
    
    Route::post('storeReviewProduct',[ReviewController::class,'storeReviewProduct']);

    Route::post("/logout",[AuthController::class,"logout"]);    

});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Customer\RatingController;
use App\Http\Controllers\Customer\ReviewController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Customer\FrontendController;
use App\Http\Controllers\Customer\WishListController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AuthCustomerController;
use App\Http\Controllers\Customer\HomeController;

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
route::post("registerCustomer",[AuthCustomerController::class,'register']);
route::post("loginCustomer",[AuthCustomerController::class,'login']);

 // viewers
    route::get('viewerIndex',[FrontendController::class,'index']);
    route::get("/activeCategory",[FrontendController::class,'activeCategory']);
    route::get("/viewProduct/{product_slug}",[FrontendController::class,'viewProduct']);
    route::get("/activeProductByCategory/{categoryid}",[FrontendController::class,'activeProductByCategory']);
    Route::get('productSearch/{search}',[FrontendController::class,'productSearch']);
    Route::get('bestSeller/{category}',[FrontendController::class,'bestSeller']);
    Route::get('newArrivals/{days}',[FrontendController::class,'newArrivals']);
    Route::get('getAllcategory',[FrontendController::class,'getAllcategory']);
    Route::get('getAllProduct',[FrontendController::class,'getAllProduct']);
    Route::get('productDetails/{slug}',[FrontendController::class,'productDetails']);
    Route::get('productByCategory/{slug}',[FrontendController::class,'productByCategory']);
    Route::get('productBySubCategory/{slug}',[FrontendController::class,'productBySubCategory']);
    Route::get('ProductBrand/{slug}',[FrontendController::class,'ProductBrand']);
    Route::get('productGrids',[FrontendController::class,'productGrids']);
    Route::get('sortProductByName/{sort}',[FrontendController::class,'sortProductByName']);
    Route::get('sortProductByPrice/{sort}',[FrontendController::class,'sortProductByPrice']);
    Route::get('productByRangePrice',[FrontendController::class,'productByRangePrice']);


Route::group(["middleware"=> ["auth:sanctum"]],function(){
    // front end
    // cartController
    route::get('/index',[CartController::class,'index']);
    route::get('/CartCount',[CartController::class,'CartCount']);
    route::post('/addToCart',[CartController::class,'addToCart']);
    route::post('/remove',[CartController::class,'remove']);
    route::get('/subTotalprice',[CartController::class,'subTotalprice']);
    route::post('/deleteCart/{cart}',[CartController::class,'deleteCart']);

    // checkOutController
    route::post('/placeOrder',[CheckoutController::class,'placeOrder']);

    // WhishList
    Route::get('WishList',[WishListController::class,'index']);
    Route::get('wishList_show/{wishList}',[WishListController::class,'show']);
    Route::get('wishList_count',[WishListController::class,'wishListCount']);
    Route::post('addWishList',[WishListController::class,'addToWishList']);
    Route::post('destroy_WishList/{wishList}',[WishListController::class,'deleteWishList']);

    // Rating
    Route::post('addRating',[RatingController::class,'addRating']); 
    // Review   
    Route::post('addReview',[ReviewController::class,'addReview']);
    Route::post('updateReview/{review}',[ReviewController::class,'Update']);
    Route::delete('review/{review}',[ReviewController::class,'destroy']);
    // HomController
    route::post('/changePassword',[HomeController::class,'ChangeCustomerPassword']);
    route::get('/profile',[HomeController::class,'profile']);
    route::post('/profileUpdate/{customer}',[HomeController::class,'profileUpdate']);
    route::get('/orderIndex',[HomeController::class,'orderIndex']);
    route::post('/customerOrderDelete/{order}',[HomeController::class,'customerOrderDelete']);
    




    // trackOrder
    route::post('/productTrackOrder',[HomeController::class,'productTrackOrder']);
     
    route::post("logoutCustomer",[AuthCustomerController::class,'logout']);

});

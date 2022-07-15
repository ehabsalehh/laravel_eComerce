<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\Review\RatingController;
use App\Http\Controllers\Customer\Review\ReviewController;
use App\Http\Controllers\Customer\Review\WishListController;
 Route::apiResource('review', ReviewController::class);
 Route::resource('wishlist', WishListController::class)->except([
  'edit','create','update'
]);
Route::resource('rating', WishListController::class)->except([
  'edit','create','update'
]);
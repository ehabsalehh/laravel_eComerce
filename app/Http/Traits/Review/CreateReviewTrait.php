<?php

namespace App\Http\Traits\Review;

use App\Models\Review;
use Illuminate\Support\Facades\Auth;

trait CreateReviewTrait
{
    protected function createReview($request){
        $user_id = Auth::id();
        $product_id = $request->product_id; 
        $user_review = $request->user_review;
        Review::updateOrCreate(
            ['user_id' => $user_id,'product_id'=>$product_id],
            ['user_review' =>$user_review]
        );
    }
}

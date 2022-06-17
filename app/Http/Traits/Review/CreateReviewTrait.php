<?php

namespace App\Http\Traits\Review;

use App\Models\Review;
use Illuminate\Support\Facades\Auth;

trait CreateReviewTrait
{
    protected function createReview($request){
        $customer_id = Auth::id();
        $product_id = $request->product_id; 
        $customer_review = $request->customer_review;
        Review::updateOrCreate(
            ['customer_id' => $customer_id,'product_id'=>$product_id],
            ['customer_review' =>$customer_review]
        );
    }
}

<?php

namespace App\Http\Traits\Rating;

use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

trait CreateRatingTrait
{
    protected function CreateRating($request){
        $customer_id = Auth::id();
        $product_id = $request->product_id; 
        $stars_rated = $request->stars_rated;
            Rating::updateOrCreate(
            ['customer_id' => $customer_id,'product_id'=>$product_id],
            ['stars_rated' => $stars_rated]
        );
    }

}

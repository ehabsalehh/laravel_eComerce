<?php

namespace App\Services\Review;

use App\Models\Review;
use App\services\ResponseMessage;
use Illuminate\Support\Facades\Auth;

class UpdateReview
{
    public function update($request,$review){
        if ($request->user()->cannot('update', $review)) {
            return ResponseMessage::failedResponse();
         }
       $review->update(['customer_review'=>$request->customer_review]);
       return ResponseMessage::succesfulResponse();
    }

}

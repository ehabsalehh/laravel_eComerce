<?php

namespace App\Services\Review;

use App\services\ResponseMessage;

class UpdateReview
{
    public function update($request,$review){
        if ($request->user()->cannot('update', $review)) {
            return ;
         }
       $review->update(['customer_review'=>$request->customer_review]);
       return ResponseMessage::succesfulResponse();
    }

}

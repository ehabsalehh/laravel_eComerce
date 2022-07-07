<?php

namespace App\Services\Review;

use App\services\ResponseMessage;

class UpdateReview
{
    public function update($request,$review){
       $review->update(['customer_review'=>$request->customer_review]);
       return ResponseMessage::succesfulResponse();
    }

}

<?php

namespace App\Http\Traits\Review;

use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\Order\verifiedPurchaseOrderTrait;
use App\services\ResponseMessage;

trait StoreProductReviewTrait
{
    use CreateReviewTrait,
    verifiedPurchaseOrderTrait
    ;
    
    protected function storeProductReview($request){
        if(count($this->verifiedPurchaseOrder($request->product_id))== 0){
            return ResponseMessage::failedResponse();
        }
        $this->createReview($request);
        return ResponseMessage::succesfulResponse();

    }
}

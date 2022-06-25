<?php

namespace App\Services\Review;

use App\services\ResponseMessage;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\Review\CreateReviewTrait;
use App\Http\Traits\Order\verifiedPurchaseOrderTrait;
use App\Models\Review;

class AddReview
{
    use verifiedPurchaseOrderTrait
    ;
    private $data;
    public function addReview($request){
        if(count($this->verifiedPurchaseOrder($request->product_id))==0){
            return ResponseMessage::failedResponse();
        }
        $this->data = $request->validated();
        $this->data['customer_id'] =Auth::id();
        Review::create($this->data);
        return ResponseMessage::succesfulResponse();

    }

}

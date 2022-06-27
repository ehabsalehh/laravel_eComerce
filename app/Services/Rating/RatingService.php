<?php
namespace App\services\Rating;
use App\services\ResponseMessage;
use App\Http\Traits\Rating\CreateRatingTrait;
use App\Http\Traits\Order\verifiedPurchaseOrderTrait;

class RatingService{
    use CreateRatingTrait,
    verifiedPurchaseOrderTrait
    ;
    public function addRating($request){
        if(count($this->verifiedPurchaseOrder($request->product_id))==0){return ;}
        $this->CreateOrUpdateRating($request);
        return ResponseMessage::succesfulResponse();
    }
}
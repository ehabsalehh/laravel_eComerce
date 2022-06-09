<?php
namespace App\services\Rating;
use App\services\ResponseMessage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\Rating\CreateRatingTrait;
use App\Http\Traits\Order\verifiedPurchaseOrderTrait;

class RatingService{
    use CreateRatingTrait,
    verifiedPurchaseOrderTrait
    ;
    public function addRating($request){
        // if user purchased Product
        if(count($this->verifiedPurchaseOrder($request->product_id))>0){
            $this->CreateRating($request);
            return ResponseMessage::succesfulResponse();        
        }
        return ResponseMessage::failedResponse();
    }
}
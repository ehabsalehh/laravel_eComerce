<?php
namespace App\Services\Customer\Review;
use App\services\ResponseMessage;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer\Review\Rating;
use App\Services\Employee\Order\VerifiedPurchaseOrder;

class StoreRating{
     private $VerifiedPurchaseOrder;
    public function store($request,VerifiedPurchaseOrder $verifiedPurchaseOrder){
        $this->VerifiedPurchaseOrder = $verifiedPurchaseOrder;
        if(empty($this->VerifiedPurchaseOrder->verifiedPurchaseOrder($request->product_id))){return ;}
        
        $this->CreateOrUpdateRating($request);
        return ResponseMessage::successResponse();
    }
    private function CreateOrUpdateRating($request){
        $request->validate([
            'product_id'=>["required","exists:products,id"],
            'stars_rated' =>['required','numeric'],
        ]);
        $customerId = auth()->id();
        $productId = $request->product_id; 
        $starsRated = $request->stars_rated;
        Rating::updateOrCreate(
        ['customer_id' => $customerId,'product_id'=>$productId],
        ['stars_rated' => $starsRated]
        );
    }
}
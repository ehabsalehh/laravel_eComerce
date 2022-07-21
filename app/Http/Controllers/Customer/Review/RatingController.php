<?php

namespace App\Http\Controllers\Customer\Review;
use Illuminate\Http\Request;
use App\services\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Resources\RatingResource;
use App\Services\Review\StoreRating;
use App\Models\Customer\Review\Rating;
use App\Services\Employee\Order\VerifiedPurchaseOrder;

class RatingController extends Controller
{
    private $store;
    public function index(){
        return RatingResource::collection(Rating::customer()->with('Customer')->get());
    }
    public function show(Rating $rating){
        return new RatingResource($rating);
    } 
    public function store(Request $request,StoreRating $store,VerifiedPurchaseOrder $verified){
        $this->store = $store;
        return $this->store->store($request,$verified);
    }
    public function destroy(Rating $rating){        
        $this->authorize('delete', $rating); 
        $rating->delete();
        return ResponseMessage::successResponse();
     }
    
}

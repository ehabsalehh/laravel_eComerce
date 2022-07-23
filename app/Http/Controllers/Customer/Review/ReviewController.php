<?php
namespace App\Http\Controllers\Customer\Review;
use Illuminate\Http\Request;
use App\services\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use App\Models\Customer\Review\Review;
use App\Services\Customer\Review\StoreReview;
use App\Services\Employee\Order\VerifiedPurchaseOrder;

class ReviewController extends Controller
{
    private $store;
    public function index(){
        return  ReviewResource::collection(Review::Customer()->with('product')->get());
    }
    public function show(Review $review){
        return new ReviewResource($review);
    } 
    public function store(Request $request,StoreReview $store,VerifiedPurchaseOrder $verified){
        $this->store = $store;
        $this->store->store($request,$verified);
        return ResponseMessage::successResponse();
    }
    public function update(Request $request, Review $Review){
        $this->authorize('update', $Review);
        $validated = $request->validate([
            'product_id'=>["required","exists:products,id"],
            'customer_review' => ['required','string']
        ]);
        $Review->update($validated);
        return ResponseMessage::successResponse();
    } 
    public function destroy(Review $review){        
       $this->authorize('delete', $review); 
       $review->delete();
       return ResponseMessage::successResponse();
    }
}

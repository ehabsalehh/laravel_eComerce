<?php
namespace App\Http\Controllers\Customer\Review;
use App\Models\Customer\Review\Review;
use App\services\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use App\Services\Employee\Order\VerifiedPurchaseOrder;
use App\Services\Review\StoreReview;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    private $store;
    public function index(){
        return  ReviewResource::collection(Review::query()->Customer()->with('product')->get());
    }
    public function show(Review $review){
        return new ReviewResource($review);
    } 
    public function store(Request $request,StoreReview $store,VerifiedPurchaseOrder $verified){
        $this->store = $store;
        return $this->store->store($request,$verified);
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

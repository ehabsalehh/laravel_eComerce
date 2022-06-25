<?php
namespace App\Http\Controllers\Customer;

use App\Models\Review;
use App\services\ResponseMessage;
use App\Services\Review\AddReview;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Review\UpdateReview;
use App\Http\Requests\StoredReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Http\Traits\Review\StoreProductReviewTrait;
use App\Http\Traits\Order\verifiedPurchaseOrderTrait;

class ReviewController extends Controller
{
    private $addReview;
    private $updateReview;

    public function addReview(StoredReviewRequest $request,AddReview $addReview){
        $this->addReview = $addReview;
        return $this->addReview->addReview($request);
        // return $this->storeProductReview($request);
    }
    public function Update(UpdateReviewRequest $request,Review $review,UpdateReview $updateReview){
        $this->updateReview = $updateReview;
        return $this->updateReview->update($request,$review);
    }
    public function destroy(Review $review){
        $this->authorize('delete', $review);
         $review->delete($review);
         return ResponseMessage::succesfulResponse();
    }
}

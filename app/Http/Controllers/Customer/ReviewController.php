<?php
namespace App\Http\Controllers\Customer;

use App\Models\Review;
use App\services\ResponseMessage;
use App\Services\Review\AddReview;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoredReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Http\Resources\ReviewResource;

class ReviewController extends Controller
{
    private $addReview;
    private $updateReview;
// public function show(Review $Review){
//     return new ReviewResource($Review);
// }
public function show($id){
    $Review= Review::findOrFail($id);
    return new ReviewResource($Review);
} 
    public function addReview(StoredReviewRequest $request,AddReview $addReview){
        $this->addReview = $addReview;
        return $this->addReview->addReview($request);
        // return $this->storeProductReview($request);
    }
    public function update(UpdateReviewRequest $request, Review $Review){
        $this->authorize('update', $Review);
        $Review->update($request->validated());
        return ResponseMessage::succesfulResponse();
    } 
   
    public function destroy($id){        
       $Review= Review::findOrFail($id);
       if (request()->user()->cannot('delete', $Review)) {
        abort(403);
        }
        $Review->delete();
        return ResponseMessage::succesfulResponse();
    }
}

<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoredReviewRequest;
use App\Http\Traits\Review\StoreProductReviewTrait;

class ReviewController extends Controller
{
    use StoreProductReviewTrait;

    public function storeReviewProduct(StoredReviewRequest $request){
        return $this->storeProductReview($request);
    }
}

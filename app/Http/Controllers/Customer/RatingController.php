<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\services\Rating\RatingService;
use App\Http\Requests\storedRatingRequest;

class RatingController extends Controller
{
    private $addRating;
    public function addRating( storedRatingRequest $request,RatingService $addRating){
        $this->addRating = $addRating;
        return $this->addRating->addRating($request);
    }
}

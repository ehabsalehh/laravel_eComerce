<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\services\Rating\RatingService;
use App\Http\Requests\storedRatingRequest;

class RatingController extends Controller
{
    public function addRating( storedRatingRequest $request){
        $addRating = new RatingService();
        return $addRating->addRating($request);
    }
}

<?php

namespace App\Services\Customer\Review;

use App\services\ResponseMessage;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer\Review\WishList;

class StoreWishlist
{
    public function store($request){
        $validated = $request->validate([
            'product_id'=>["required","exists:products,id"],
        ]);
        $validated['customer_id']= auth()->id();
         $alReadyInWishlist= WishList::getCustomer()
                                ->product($request->product_id)->get();
        if(count($alReadyInWishlist)>0){
           return  response()->json('Already placed in wishlist');
        }
        WishList::create($validated);
        return ResponseMessage::successResponse();
    }

}

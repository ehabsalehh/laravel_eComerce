<?php

namespace App\Http\Traits\WishList;

use App\Models\WishList;
use App\services\ResponseMessage;
use Illuminate\Support\Facades\Auth;

trait AddWishListTrait
{
 
    protected function addWishList($request){
         $alReadyInwishlist= WishList::where('customer_id',Auth::id())->where('product_id',$request->product_id)->get();
        if(count($alReadyInwishlist)>0){
           return  response()->json('You already placed in wishlist');
        }
        WishList::create(['customer_id' => Auth::id(),'product_id'=>$request->product_id]);
        return ResponseMessage::succesfulResponse();

    }
}



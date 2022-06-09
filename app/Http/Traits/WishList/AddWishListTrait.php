<?php

namespace App\Http\Traits\WishList;

use App\Models\WishList;
use Illuminate\Support\Facades\Auth;

trait AddWishListTrait
{
 
    protected function addWishList($request){
        $user_id = Auth::id();
        $product_id = $request->product_id; 
            WishList::updateOrCreate(
            ['user_id' => $user_id,'product_id'=>$product_id],
        );
    }
}



<?php

namespace App\Http\Traits\WishList;

use App\Models\WishList;
use Illuminate\Support\Facades\Auth;

trait AddWishListTrait
{
 
    protected function addWishList($request){
        $customer_id = Auth::id();
        $product_id = $request->product_id; 
            WishList::updateOrCreate(
            ['customer_id' => $customer_id,'product_id'=>$product_id],
        );
    }
}



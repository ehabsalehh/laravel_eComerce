<?php

namespace App\Http\Traits\Cart;

use App\Models\Cart;
use Illuminate\Support\Facades\DB;

trait QuantityLessThanOrderTrait
{
    protected function quantityLessThanOrder ($quantity,$orderQuantity){
        //  $cart = Cart::where('product_id',$request->product_id)
        //  ->select(DB::raw('sum(quantity) as quantity'))->groupBy('product_id')->first();
        //  $quantity = isset($cart->quantity)?$cart->quantity+$request->quantity:null;
        // return $quantity <($quantity??$request->quantity);
        return $quantity <$orderQuantity;
    }

}

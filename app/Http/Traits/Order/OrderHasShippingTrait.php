<?php

namespace App\Http\Traits\Order;

use App\Models\Shipping;
use App\Http\Traits\Cart\CartTotalPriceTrait;

trait OrderHasShippingTrait
{
    protected function orderHasShipping($request){
        if($request->shipping_id){
            $shipping =Shipping::where('id', $request->shipping_id)->select('price')->first();  
            return $shipping->price;    
        }
    }

}

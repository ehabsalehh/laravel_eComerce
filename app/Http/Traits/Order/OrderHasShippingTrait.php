<?php

namespace App\Http\Traits\Order;

use App\Models\Shipping;

trait OrderHasShippingTrait
{
    protected function orderHasShipping($request){
        if($request->shipping_id){
            $shipping =Shipping::where('id', $request->shipping_id)->select('price')->first();  
            return ($shipping->price)||0;    
        }
    }

}

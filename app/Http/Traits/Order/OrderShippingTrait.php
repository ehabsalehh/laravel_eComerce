<?php

namespace App\Http\Traits\Order;

use App\Models\Shipping;

trait OrderShippingTrait
{
    protected function orderShipping($request){
        return Shipping::where('id', $request->shipping_id)->select('price')->first();
    }

}

<?php

namespace App\Http\Traits\OrderItem;

use App\Models\OrderItem;

trait GetOrderItemTrait
{
    protected function getOrderItem($request){
       return OrderItem::GetOrrderItems($request->order_id)
                    ->HasProduct($request->product_id)
                    ->GetOrderOwner($request->customer_id)->select('id','order_id','product_quantity','price','created_at')
                    ->first();
    }

}

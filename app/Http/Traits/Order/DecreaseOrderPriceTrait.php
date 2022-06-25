<?php

namespace App\Http\Traits\Order;

trait DecreaseOrderPriceTrait
{
    protected function orderHasNotDiscount($getProductOrderItem,$order){
        if(is_null($getProductOrderItem->discount)){
            $order->sub_total -=  $getProductOrderItem->price;
            $order->total -=  $getProductOrderItem->price;
            $order->save();
        }
    }
}

<?php

namespace App\Http\Traits\Order;

trait DecreaseOrderPriceHasDiscountTrait
{
    protected function orderHasDiscount($getProductOrderItem,$order){
        if(!empty($getProductOrderItem->discount)){
            $discount= $getProductOrderItem->discount->first();
            $Price = $getProductOrderItem->price;
            $percentValue = 1/$discount->percent *$Price;
            $PriceWithDiscount = $percentValue +$Price;
            // 
            $order->sub_total -=  $Price;
            $order->total_discount -= $percentValue;
            $order->total -=  $PriceWithDiscount;
            $order->save();
        }
    }

}

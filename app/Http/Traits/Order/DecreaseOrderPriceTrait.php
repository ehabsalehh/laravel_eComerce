<?php

namespace App\Http\Traits\Order;

use App\Models\Payment;

trait DecreaseOrderPriceTrait
{
    protected function orderHasNotDiscount($getProductOrderItem,$order){
        if(is_null($getProductOrderItem->discount)){
            $taxValue= $getProductOrderItem->price/100*$getProductOrderItem->price;
            $priceWithTax= $getProductOrderItem->price +$taxValue;
            $order->sub_total -=  $priceWithTax;//with tax
            $order->total -= $priceWithTax;
            $order->save();
    
        }
    }
}

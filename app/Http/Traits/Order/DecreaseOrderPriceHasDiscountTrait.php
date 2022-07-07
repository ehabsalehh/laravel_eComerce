<?php

namespace App\Http\Traits\Order;

use App\Models\Payment;

trait DecreaseOrderPriceHasDiscountTrait
{
    protected function orderHasDiscount($getProductOrderItem,$order){
        if(isset($getProductOrderItem->discount)){
            $discount= $getProductOrderItem->discount->first();
            $taxValue= $getProductOrderItem->tax/100*$getProductOrderItem->price;//20
            $priceWithTax= $getProductOrderItem->price +$taxValue;//220
            $discountValue = $discount->percent/100 * $priceWithTax;//22
            $PriceWithDiscount = $priceWithTax- $discountValue ;//198

            $order->sub_total -=  $priceWithTax;//with tax
            $order->total_discount -= $discountValue;
            $order->total -= $PriceWithDiscount;
            $order->save();           
        }
    }

}

<?php

namespace App\Http\Traits\OrderItem;

use App\Models\OrderItem;

trait DeleteOrderItemTrait
{
    use GetOrderItemTrait;
    protected function deleteOrderItem($request){
        $getOrderItem= $this->getOrderItem($request);
        $getOrderItem->when($getOrderItem->product_quantity == 1, function ()use($getOrderItem)  {
            $orderItem =OrderItem::findOrFail($getOrderItem->id);
            $totalOrderItemPrice = $orderItem->product_quantity * $orderItem->price;
            $orderItem->Delete();
            return $totalOrderItemPrice;
        });
        

        
        // if($getOrderItem->product_quantity > 1){
        //     $orderItem =OrderItem::findOrFail($getOrderItem->id);
        //     $orderItem->product_quantity = $orderItem->product_quantity -1;
        //     $orderItem->save();
        //     return "succes";
        // }
    }


}

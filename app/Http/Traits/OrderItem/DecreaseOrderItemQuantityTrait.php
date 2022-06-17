<?php

namespace App\Http\Traits\OrderItem;

use App\Models\OrderItem;

trait DecreaseOrderItemQuantityTrait
{
    use GetOrderItemTrait;
    protected function DecreaseOrderItemQuantity($request){
        $getOrderItem= $this->getOrderItem($request);
        $getOrderItem->when($getOrderItem->product_quantity > 1, function ()use($getOrderItem)  {
            $orderItem =OrderItem::findOrFail($getOrderItem->id);
            $orderItem->product_quantity = $orderItem->product_quantity -1;
            $orderItem->save();
        });
        $getOrderItem->when($getOrderItem->product_quantity == 1, function ()use($getOrderItem)  {
            $orderItem =OrderItem::findOrFail($getOrderItem->id);
            $orderItem->delete();
        });
               
                
    }

}

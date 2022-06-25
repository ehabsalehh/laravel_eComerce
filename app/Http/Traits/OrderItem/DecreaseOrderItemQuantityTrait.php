<?php

namespace App\Http\Traits\OrderItem;
trait DecreaseOrderItemQuantityTrait
{
    protected function DecreaseOrderItemQuantity($orderItems,$inventory){
        if($orderItems->quantity == 1){
            $orderItems->delete();
            $inventory->quantity +=1;
            $inventory->save();
        }
        if($orderItems->quantity > 1){
            $orderItems->quantity -=1;
            $orderItems->save();
            $inventory->quantity +=1;
            $inventory->save();
        }            
    }

}

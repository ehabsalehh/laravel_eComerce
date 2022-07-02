<?php

namespace App\Http\Traits\Order;

use App\Models\OrderItem;
use App\Http\Traits\Product\DecreseInventoryQuantityTrait;

trait ProcessOrderStatusTrait
{
    use DecreseInventoryQuantityTrait;

    protected function processOrderStatus($order){
        $order->when($order->status == 'process',function()use($order){
            $orderItem = OrderItem::getOrderItems($order->id)->get();
            $orderItem->map(function($item){
                // if order status not new 
                $this->decreseInventoryQuantity($item);
            });
        });
    }

}

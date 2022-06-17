<?php
namespace App\Http\Traits\OrderItem;
use App\Models\OrderItem;
trait CreateOrderItemTrait{
    protected function CreateOrderItem($orderid,$item){
            OrderItem::create([
                'order_id' => $orderid,
                'product_id'=>$item->product_id,
                'customer_id'=>$item->customer_id,
                'product_quantity'=>$item->product_quantity,
                'price'=>$item->product->selling_price,
            ]);
    
    }
}
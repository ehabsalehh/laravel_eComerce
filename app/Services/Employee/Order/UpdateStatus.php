<?php

namespace App\Services\Employee\Order;

use App\services\ResponseMessage;
use App\Models\Employee\Product\Inventory;
use App\Models\Customer\Checkout\OrderItem;

class UpdateStatus
{
    public function updateStatus($request,$order){
        $validated= $request->validate([
            'status' =>["required","in:new,process,delivered,cancel"]
        ]);
        $order->update($validated);
        $order->when($order->status == 'process',function()use($order){
            $orderItem = OrderItem::getOrderItems($order->id)->get();
            $orderItem->map(function($item){
                $inventory= Inventory::getInventoryProduct($item->product_id)->first();
                $inventory->quantity -=  $item->quantity; 
                $inventory->save();
            });
        });        
        $order->when($order->status == 'cancel',function()use($order){
            $order->orderItems()->delete();
            $order->delete();
        });
        return ResponseMessage::successResponse();
    }

}

<?php

namespace App\Services\Employee\Order;
use Request;
use App\Models\Customer;
use App\Mail\OrderShipped;
use App\services\ResponseMessage;
use Mail;
use App\Models\Customer\Checkout\Order;
use App\Models\Employee\Product\Inventory;
use App\Models\Customer\Checkout\OrderItem;

class UpdateStatus
{
    public function updateStatus($request, Order $order){
       
        $validated= $request->validate([
            'status' =>["required","in:new,process,delivered,cancel"]
        ]);
         $order->update($validated);
        $order->update(['status'=>'process']);
        $order->when($order->status == 'process',function()use($order){
            $orderItem = OrderItem::getOrderItems($order->id)->get();
            $CustomerEmail = Customer::where('id',$orderItem[0]->customer_id)
                                    ->select('email')->first();
            Mail::to($CustomerEmail->email)->send(new OrderShipped());  
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

<?php

namespace App\Services\Employee\Order;
use Mail;
use App\Models\Customer;
use App\Mail\OrderShipped;
use App\services\ResponseMessage;
use Illuminate\Validation\Rules\Enum;
use App\Models\Customer\Checkout\Order;
use App\Enums\Employee\Order\OrderStatus;
use App\Models\Employee\Product\Inventory;
use App\Models\Customer\Checkout\OrderItem;

class UpdateStatus
{
    public function updateStatus($request, Order $order){
       
        $validated= $request->validate([
            'status'=> ["required",new Enum(OrderStatus::class)],
        ]);
         $order->update($validated);
        $order->update(['status'=>OrderStatus::Process]);
        $order->when($order->status == OrderStatus::Process,function()use($order){
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
        $order->when($order->status == OrderStatus::Cancel,function()use($order){
            $order->orderItems()->delete();
            $order->delete();
        });
        return ResponseMessage::successResponse();
    }

}

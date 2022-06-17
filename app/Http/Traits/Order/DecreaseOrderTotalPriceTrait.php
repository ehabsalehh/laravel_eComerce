<?php

namespace App\Http\Traits\Order;

use App\Models\Order;
use Illuminate\Support\Carbon;
use App\services\ResponseMessage;
use App\Http\Traits\OrderItem\GetOrderItemTrait;
use App\Http\Traits\Product\DecreseProductQuantityTrait;
use App\Http\Traits\OrderItem\DecreaseOrderItemQuantityTrait;

trait DecreaseOrderTotalPriceTrait
{
    use GetOrderItemTrait,
        DecreaseOrderItemQuantityTrait
    ;
    protected function decreaseOrderTotalPrice($request){
        try {
            $getOrderItem =$this->getOrderItem($request);
            // order Should be sold before 15 days to return
            $created = new Carbon($getOrderItem->created_at);
            $now = Carbon::now();
            if($created->diff($now)->days <15){return ResponseMessage::failedResponse();}
            $this->DecreaseOrderItemQuantity($request);
            $order = Order::findOrFail($getOrderItem->order_id);
            $order->total_price -= $getOrderItem->price; 
            $order->save();
            $order->when($order->total_price == 0,fn () =>$order->delete());    
        return ResponseMessage::succesfulResponse();    
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
        
    }

}

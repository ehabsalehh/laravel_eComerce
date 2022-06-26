<?php

namespace App\Services\Order;

use App\Models\Order;
use App\Models\OrderItem;
use App\services\ResponseMessage;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\Product\DecreseProductQuantityTrait;

class DecreaseInventoryQuantityService
{
     use DecreseProductQuantityTrait;
    public function decreaseQuantity($request){
        $order = Order::where('order_number',$request->order_number)
         ->where('status','<>','new')
         ->first();
         if(!empty($order)){
            $orderitem= OrderItem::getOrderOwner(Auth::id())->getOrrderItems($order->id)->get();
             foreach($orderitem as $item){
                $this->decreseInventoryQuantity($item);
            }
            return ResponseMessage::succesfulResponse();
         }
    }

}

<?php

namespace App\Http\Traits\Order;

use App\Models\Order;
use App\services\ResponseMessage;

trait UpdateOrderStausTrait
{
    protected function updateOrderStaus($request){
        $order = Order::findOrFail($request->id);
        $order->status = $request->status;
        $order->save();
        return ResponseMessage::succesfulResponse();
    }

}

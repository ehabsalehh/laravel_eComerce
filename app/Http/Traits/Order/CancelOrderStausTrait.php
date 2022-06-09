<?php

namespace App\Http\Traits\Order;

use App\Models\Order;
use App\Models\OrderItem;
use App\services\ResponseMessage;

trait CancelOrderStausTrait
{
    protected function cancelOrderStaus($order){
        $orderItem= OrderItem::where('order_id' ,$order->id)->get()->pluck('id');
            OrderItem::destroy($orderItem);
            $order->delete();
            return ResponseMessage::succesfulResponse();

    }

}

<?php

namespace App\Http\Traits\Order;

use App\Models\Order;
use App\Models\OrderItem;
use App\services\ResponseMessage;

trait CancelOrderStausTrait
{
    protected function cancelOrderStaus($order){
        $order->when($order->status == 'cancel',function()use($order){
            // $order->orderItems->delete();
            $order->delete();
        });

    }

}

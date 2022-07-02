<?php

namespace App\Http\Traits\Order;

use App\Models\Order;
use App\Models\OrderItem;
use App\services\ResponseMessage;
use App\Http\Traits\Order\CancelOrderStausTrait;
use App\Http\Traits\Order\ProcessOrderStatusTrait;
use App\Http\Traits\Product\DecreseInventoryQuantityTrait;

trait UpdateOrderStausTrait
{
    use DecreseInventoryQuantityTrait,
    ProcessOrderStatusTrait,
    CancelOrderStausTrait
    ;
    protected function updateOrderStaus($request,$order){
        $order->update($request->validated());
        $this->processOrderStatus($order);
        $this->cancelOrderStaus($order);
        return ResponseMessage::succesfulResponse();
    }

}

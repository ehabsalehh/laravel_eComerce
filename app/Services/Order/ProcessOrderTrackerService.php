<?php

namespace App\Services\Order;

use App\Http\Interface\OrderTrackerInterface;

class ProcessOrderTrackerService implements OrderTrackerInterface
{
    public function getSupportedMessageType(){
        return Response()->json('Your order is under processing please wait..');
    }
}
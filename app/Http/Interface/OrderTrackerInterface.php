<?php

namespace App\Http\Interface;

use App\Models\Order;

interface OrderTrackerInterface
{

    public function getSupportedMessageType();
}

<?php

namespace App\Enums\Employee\Order;

enum ShippingStatus :int
{
    case Active = 1;
    case Inactive = 2;
}

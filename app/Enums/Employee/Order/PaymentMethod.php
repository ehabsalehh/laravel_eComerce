<?php

namespace App\Enums\Employee\Order;

enum PaymentMethod :int
{
    case Cod = 1;
    case Paypal = 2;
}

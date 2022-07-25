<?php

namespace App\Enums\Employee\Order;

enum PaymentStatus :int
{
    case Paid = 1;
    case Unpaid = 2;
}

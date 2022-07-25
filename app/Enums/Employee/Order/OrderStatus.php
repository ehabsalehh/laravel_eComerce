<?php

namespace App\Enums\Employee\Order;

enum OrderStatus :int
{
    case New = 1;
    case Process = 2;
    case Delivered = 3;
    case Cancel = 4;
}

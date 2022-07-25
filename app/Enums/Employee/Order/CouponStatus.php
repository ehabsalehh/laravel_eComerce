<?php

namespace App\Enums\Employee\Order;

enum CouponStatus :int
{
    case Active = 1;
    case Inactive = 2;
}

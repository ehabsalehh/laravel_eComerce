<?php

namespace App\Http\Traits\Order;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

trait OldOlderthanNumberDaysTrait
{
    public function oldOlderthanNumberDays(Model $orderItems, int $days):bool
    {
        return $orderItems->created_at <Carbon::now()->subDays(15);
        
    }

}

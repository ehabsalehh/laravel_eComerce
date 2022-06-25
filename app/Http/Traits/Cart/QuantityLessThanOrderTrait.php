<?php

namespace App\Http\Traits\Cart;

use App\Models\Cart;
use Illuminate\Support\Facades\DB;

trait QuantityLessThanOrderTrait
{
    protected function quantityLessThanOrder ($quantity,$orderQuantity){
        return $quantity <$orderQuantity;
    }

}

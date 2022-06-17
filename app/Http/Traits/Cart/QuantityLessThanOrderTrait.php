<?php

namespace App\Http\Traits\Cart;

trait QuantityLessThanOrderTrait
{
    protected function quantityLessThanOrder ($quantity,$orderQuantity){
        return $quantity <$orderQuantity;
    }

}

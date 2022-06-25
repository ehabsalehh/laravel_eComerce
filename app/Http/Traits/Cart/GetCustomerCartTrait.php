<?php

namespace App\Http\Traits\Cart;

use App\Models\Cart;
trait GetCustomerCartTrait
{
    protected function getCustomerCart(){
        return Cart::customerId(auth()->user()->id)->get();
    }
}

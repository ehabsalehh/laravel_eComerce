<?php

namespace App\Http\Traits\Cart;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

trait GetCustomerCartTrait
{
    protected function getCustomerCart(){
        return Cart::CustomerId(Auth::id())->get();
    }
}

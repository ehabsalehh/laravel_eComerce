<?php

namespace App\Http\Traits\Cart;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

trait GetCustomerCartTraitWith
{
    protected function getCustomerCartWith(){
        return Cart::CustomerId(Auth::id())->with('product','Customer')->get();
    }
}

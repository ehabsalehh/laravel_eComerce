<?php

namespace App\Http\Traits\Cart;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

trait DestroyCustomerCartTrait
{
protected function destroyCustomerCart(){
    $cartItems= Cart::customerId(Auth::id())->pluck('id');
   Cart::whereIn('id',$cartItems)->delete();
}
}

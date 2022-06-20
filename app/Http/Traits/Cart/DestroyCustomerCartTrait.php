<?php

namespace App\Http\Traits\Cart;

use App\Models\Cart;

trait DestroyCustomerCartTrait
{
use GetCustomerCartTrait;
protected function destroyCustomerCart(){
    $cartItems = $this->getCustomerCart();
     Cart::destroy($cartItems);
}
}

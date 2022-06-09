<?php

namespace App\Http\Traits\Cart;

use App\Models\Cart;

trait DestroyUserCartTrait
{
use GetUserCartTrait;
protected function destroyUserCart(){
    $cartItems = $this->getUserCart();
     Cart::destroy($cartItems);
}
}

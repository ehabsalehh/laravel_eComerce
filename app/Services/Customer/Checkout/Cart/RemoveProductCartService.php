<?php

namespace App\Services\Cart;

use App\services\ResponseMessage;
use App\Models\Customer\Checkout\Cart;

class RemoveProductCartService
{
    public function removeFromCart($cart){
        $cart->when(isset($cart),
                        fn()=> $cart->decrement('quantity', 1));
        $cart->when(empty($cart->quantity),
                         fn ()=> $cart->delete());      
    } 
}

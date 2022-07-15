<?php

namespace App\Services\Cart;

use App\services\ResponseMessage;
use App\Models\Customer\Checkout\Cart;

class RemoveProductCartService
{
    private $cart;
    public function removeFromCart($cartId){
        $this->cart = Cart::findOrFail($cartId);
        $this->cart->when(isset($this->cart),
                        fn()=> $this->cart->decrement('quantity', 1));
        $this->cart->when(empty($this->cart->quantity),
                         fn ()=> $this->cart->delete());      
    } 
}

<?php

namespace App\Services\Cart;

use App\services\ResponseMessage;
use App\Models\Cart;

class RemoveProductCartService
{
    private $cart;
    public function removeFromCart($cartId){
        $this->cart = Cart::findOrFail($cartId);
        if (request()->user()->cannot('delete', $this->cart)) {
            abort(403);
        }
        $this->cart->when(isset($this->cart),
                        fn()=> $this->cart->decrement('quantity', 1));
        $this->cart->when(empty($this->cart->quantity),
                         fn ()=> $this->cart->delete());      
    } 
}

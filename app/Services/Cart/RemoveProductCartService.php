<?php

namespace App\Services\Cart;

use App\services\ResponseMessage;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\Cart\GetCartproductTrait;
use App\Http\Traits\Cart\QuantiyLessThanOneTrait;
use App\Models\Cart;

class RemoveProductCartService
{
    use QuantiyLessThanOneTrait,
    GetCartproductTrait
    ;
    private $cart;
    public function removeFromCart($request){
        $this->cart = $this->getCartproduct($request->product_id,Auth::id());
        $this->cart->decrement('quantity', 1);
        $this->cart->when(empty($this->cart->quantity), fn ()=> $this->cart->delete()); 
         return ResponseMessage::succesfulResponse();
    } 
}

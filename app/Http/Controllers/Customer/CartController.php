<?php

namespace App\Http\Controllers\Customer;

use App\Models\Cart;
use App\services\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Resources\cartResource;
use Illuminate\Support\Facades\Auth;
use App\services\Cart\AddToCartService;
use App\Http\Requests\storedCartRequest;
use App\Services\Cart\RemoveProductCartService;
use App\Http\Traits\Cart\GetCustomerCartTraitWith;

class CartController extends Controller
{
   private $addToCart;
   private $removeFromCart;
   use GetCustomerCartTraitWith
   ;
    
    public function index (){
         return  cartResource::collection($this->getCustomerCartWith());
    }

     public function store(storedCartRequest $request, AddToCartService $addToCart){
         $this->addToCart =$addToCart;
        return  $this->addToCart->addToCart($request);
     }
     public function CartCount(){
      return  Cart::CustomerId(Auth::id())->count();
   }
     public function remove($cartId,RemoveProductCartService $removeProductCartService){   
         $this->removeFromCart =$removeProductCartService;
         $this->removeFromCart->removeFromCart($cartId);
         return ResponseMessage::succesfulResponse();
     }
     public function  delete(Cart $cart){
      
         $this->authorize('delete', $cart);
         $cart->delete();
         return ResponseMessage::succesfulResponse();
     } 
}

<?php

namespace App\Http\Controllers\Customer\Checkout;

use App\Models\Customer\Checkout\Cart;
use App\services\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Resources\cartResource;
use Illuminate\Support\Facades\Auth;
use App\services\Cart\AddToCartService;
use App\Http\Requests\storedCartRequest;
use App\Services\Cart\RemoveProductCartService;
class CartController extends Controller
{
   private $addToCart;
   private $removeFromCart;   
    public function index (){
        $customerCart = Cart::CustomerId(Auth::id())->with('product','Customer')->get();
         return  cartResource::collection($customerCart);
    }
     public function store(storedCartRequest $request, AddToCartService $addToCart){
         $this->addToCart =$addToCart;
        return  $this->addToCart->addToCart($request);
     }
     public function CartCount(){
      return  Cart::CustomerId(Auth::id())->count();
   }
     public function remove($cartId,RemoveProductCartService $removeProductCartService){  
         $this->authorize('delete', $this->cart); 
         $this->removeFromCart =$removeProductCartService;
         $this->removeFromCart->removeFromCart($cartId);
         return ResponseMessage::successResponse();
     }
     public function  delete(Cart $cart){
      
         $this->authorize('delete', $cart);
         $cart->delete();
         return ResponseMessage::successResponse();
     } 
}

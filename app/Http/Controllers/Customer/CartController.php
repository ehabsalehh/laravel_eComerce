<?php

namespace App\Http\Controllers\Customer;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\services\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Resources\cartResource;
use Illuminate\Support\Facades\Auth;
use App\services\Cart\AddToCartService;
use App\Http\Requests\storedCartRequest;
use App\Http\Traits\Cart\SubTotalPriceTrait;
use App\Http\Requests\RemoveCartProductRequest;
use App\Services\Cart\RemoveProductCartService;
use App\Http\Traits\Cart\GetCustomerCartTraitWith;

class CartController extends Controller
{
   private $addToCart;
   private $removeFromCart;
   use GetCustomerCartTraitWith,
   SubTotalPriceTrait
   ;
    
    public function index (){
         return  cartResource::collection($this->getCustomerCartWith());
    }
    public function subTotalprice(){ 
     return  $this->subTotal();
   
    }

     public function addToCart(storedCartRequest $request, AddToCartService $addToCart){
         $this->addToCart =$addToCart;
        return  $this->addToCart->addToCart($request);
     }
     public function CartCount(){
      return  Cart::CustomerId(Auth::id())->count();
   }
   // when order status canceld
     public function remove(RemoveCartProductRequest $request,RemoveProductCartService $removeProductCartService){
         $this->removeFromCart =$removeProductCartService;
        return $this->removeFromCart->removeFromCart($request);
     }
     public function  deleteCart(Request $request,Cart $cart){
        if ($request->user()->cannot('update', $cart)) {
            return;
         }
         $cart->delete();
         return ResponseMessage::succesfulResponse();
     } 
}

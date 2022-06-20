<?php

namespace App\Http\Controllers\Customer;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\services\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Resources\cartResource;
use App\services\Cart\AddToCartService;
use App\Http\Requests\storedCartRequest;
use App\Services\Cart\UpdateCartService;
use App\Http\Traits\Cart\CartTotalPriceTrait;
use App\Http\Traits\Cart\GetAllCartWithTrait;
use App\Http\Requests\RemoveCartProductRequest;
use App\Services\Cart\RemoveProductCartService;
use App\Http\Traits\Cart\GetCustomerCartTraitWith;

class CartController extends Controller
{
   private $addToCart;
   private $removeFromCart;
   use GetCustomerCartTraitWith,
   GetAllCartWithTrait,
   CartTotalPriceTrait
   ;
    
    public function index (){
         return  cartResource::collection($this->getAllCartWith());
    }
    public function totalPrice(){
     return  $this->total_Price();
    }

     public function addToCart(storedCartRequest $request, AddToCartService $addToCart){
         $this->addToCart =$addToCart;
        return  $this->addToCart->addToCart($request);
     }
     public function viewCart(){
        return  cartResource::collection($this->getCustomerCartWith()) ;
     }
     public function CartCount(){
      return $this->viewCart()->count();
   }
     public function remove(RemoveCartProductRequest $request,RemoveProductCartService $removeProductCartService){
         $this->removeFromCart =$removeProductCartService;
        return $this->removeFromCart->removeFromCart($request);
     }
     public function  deleteCart(Request $request,Cart $cart){
        if ($request->user()->cannot('delete', $cart)) {
            return ResponseMessage::failedResponse();        }
         $cart->delete();
         return ResponseMessage::succesfulResponse();
     } 
}

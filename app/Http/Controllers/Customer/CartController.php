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
use App\Http\Traits\Cart\GetAllCartWithTrait;
use App\Http\Traits\Cart\GetCustomerCartTraitWith;

class CartController extends Controller
{
   use GetCustomerCartTraitWith,
   GetAllCartWithTrait
   ;
    
    public function index (){
         return  cartResource::collection($this->getAllCartWith());
    }

     public function addToCart(storedCartRequest $request){
         $addTocart = new AddToCartService();
        return  $addTocart->addToCart($request);
     }
     public function viewCart(){
        return  cartResource::collection($this->getCustomerCartWith()) ;
     }
     public function CartCount(){
      return $this->viewCart()->count();
   }
     public function updateCart(storedCartRequest $request){
         $updateCart =new UpdateCartService();
        return $updateCart->updateCart($request);
     }
     public function  deleteCart(Request $request,Cart $cart){
        if ($request->user()->cannot('delete', $cart)) {
            return ResponseMessage::failedResponse();        }
         $cart->delete();
         return ResponseMessage::succesfulResponse();
     } 
}

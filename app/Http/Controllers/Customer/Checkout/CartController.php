<?php
namespace App\Http\Controllers\Customer\Checkout;
use App\services\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Resources\cartResource;
use App\Models\Customer\Checkout\Cart;
use App\Services\Cart\RemoveProductCartService;
use App\services\Customer\Checkout\Cart\AddToCartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
   private $addToCart;
   private $removeFromCart;   
    public function index (){
        $customerCart = Cart::CustomerId(auth()->id())->with('product','Customer')->get();
         return  cartResource::collection($customerCart);
    }
     public function store(Request $request, AddToCartService $addToCart){ 
        $this->addToCart =$addToCart;
        return  $this->addToCart->addToCart($request);
     }
     public function update(Request $request, Cart $cart){
        $validated = $request->validate([
            'product_id' =>['required','numeric'],
            'quantity' =>['required','numeric',],
        ]);
        $cart->update($validated);
        return ResponseMessage::successResponse();
     }
     
     public function destroy(Cart $cart){
         $this->authorize('delete', $cart);
         $cart->delete();
         return ResponseMessage::successResponse();
     }
     public function remove(Cart $cart,RemoveProductCartService $removeProductCartService){  
        $this->authorize('delete', $cart); 
        request()->validate([
            'product_id' =>['required','exists:products,id']
        ]);
        $this->removeFromCart =$removeProductCartService;
        $this->removeFromCart->removeFromCart($cart);
        return ResponseMessage::successResponse();
    } 
    
}

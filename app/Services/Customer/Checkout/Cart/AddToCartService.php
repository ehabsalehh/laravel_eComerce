<?php
namespace App\services\Customer\Checkout\Cart;
use App\services\ResponseMessage;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer\Checkout\Cart;
use App\Models\Employee\Product\Inventory;
use Illuminate\Http\Request;

class AddToCartService { 
    private $totalOrderQuantity;
    public function addToCart( $request){
         $inventory = Inventory::where('product_id',$request->product_id)
                                ->select('quantity')->first();
        if(!$inventory
            || $this->lessThanOne($request->quantity) 
            ||$this->quantityLessThanOrder($inventory->quantity,$request->quantity)){
            return ;
        }
        $alreadyInCart= $this->getCartProduct($request->product_id,auth()->id());
        if(empty($alreadyInCart)){
            return $this->createNewCart($request);
        }
        $totalOrderQuantity = $this->totalOrderQuantity(
                    $request->quantity,$alreadyInCart->quantity);
        if($this->quantityLessThanOrder($inventory->quantity,$totalOrderQuantity)){
            return ;
        }
        $this->increaseQuantity($alreadyInCart,$request);
        $alreadyInCart->save();
        return ResponseMessage::successResponse();
    
    }
    private function  createNewCart($request){
        $validated =$request->validate([
            'product_id' =>['required','numeric'],
            'quantity' =>['required','numeric',],
        ]);
        $validated['customer_id'] = auth()->id();
        Cart::create($validated);
        return ResponseMessage::successResponse();
    }
    private function increaseQuantity($product,$request){
        $product->quantity += $request->quantity;
    }
    private function getCartProduct($product_id,$customer_id){
        return Cart::ProductId($product_id)->customerId($customer_id)->first();
     } 
    private  function lessThanOne($number){
        return $number <1;
    }
    private function totalOrderQuantity($requestQuantity,$quantity){
        return $requestQuantity + $quantity;
     }
    private function quantityLessThanOrder ($quantity,$orderQuantity){
        return $quantity <$orderQuantity;
    }
}
<?php
namespace App\services\Cart;
use App\services\ResponseMessage;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer\Checkout\Cart;
use App\Models\Employee\Product\Inventory;
class AddToCartService {
    private $inventory;
    private $alreadyInCart; 
    private $totalOrderQuantity;
    public function addToCart($request){
         $this->inventory = Inventory::where('product_id',$request->product_id)
                                    ->select('quantity')->first();
        if(!$this->inventory|| $this->quantityLessThanOne($request->quantity) 
                    ||$this->quantityLessThanOrder($this->inventory->quantity,$request->quantity)){
            return ;
        }
        $this->alreadyInCart= $this->getCartProduct($request->product_id,Auth::id());
        if(empty($this->alreadyInCart)){
            return $this->createNewCart($request);
        }
        $this->totalOrderQuantity = $this->totalOrderQuantity(
                    $request->quantity,$this->alreadyInCart->quantity);
        if($this->quantityLessThanOrder($this->inventory->quantity,$this->totalOrderQuantity)){
            return ;
        }
        $this->increaseProductQuantity($this->alreadyInCart,$request);
        $this->alreadyInCart->save();
        return ResponseMessage::successResponse();
    
    }
    private function  createNewCart($request){
        $data= $request->validated();
        $data['customer_id'] = Auth::id();
        Cart::create($data);
        return ResponseMessage::successResponse();
    }
    private function increaseProductQuantity($product,$request){
        $product->quantity += $request->quantity;
    }
    private function getCartProduct($product_id,$customer_id){
        return Cart::ProductId($product_id)->customerId($customer_id)->first();
     } 
    private  function quantityLessThanOne($number){
        return $number <1;
    }
    private function totalOrderQuantity($requestQuantity,$quantity){
        return $requestQuantity + $quantity;
     }
    private function quantityLessThanOrder ($quantity,$orderQuantity){
        return $quantity <$orderQuantity;
    }
}
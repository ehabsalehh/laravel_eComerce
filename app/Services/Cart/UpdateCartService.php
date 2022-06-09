<?php

namespace App\Services\Cart;

use App\services\ResponseMessage;
use Illuminate\Support\Facades\Auth;
use App\Services\QuantityLessThanOne;
use App\Http\Traits\Product\GetProductTrait;
use App\Http\Traits\Cart\GetCartproductTrait;


class UpdateCartService
{
    use GetProductTrait,
    GetCartproductTrait
    ;
    public function updateCart($request){
        $product = $this->getProduct($request->product_id);
        // check if there are proucts less than order quantity or product quantity less than  request of product_quantity
        if(QuantityLessThanOne::quantityLessThanOne($request->product_quantity) || 
                $product->quantity < ($request->product_quantity) ){
            return ResponseMessage::failedResponse();
        }
        $cart =  $this->getCartproduct($product->id,Auth::id());
        $cart->update($request->all());
        return ResponseMessage::succesfulResponse();        
    } 
}

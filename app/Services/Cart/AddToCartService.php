<?php
namespace App\services\Cart;

use App\Models\Cart;
use App\Models\Product;
use App\services\ResponseMessage;
use Illuminate\Support\Facades\Auth;
use App\Services\QuantityLessThanOne;
use App\Http\Traits\Cart\CreateNewCartTrait;
use App\Http\Traits\Product\GetProductTrait;
use App\Http\Traits\Cart\GetCartproductTrait;
use App\Http\Traits\Cart\QuantityLessThanOrderTrait;
use App\Http\Traits\Cart\IsProductIdExistINCartTrait;
use App\Http\Traits\Product\IncreseProductQuantityTrait;

class AddToCartService {
    use GetProductTrait,
    IsProductIdExistINCartTrait,
    GetCartproductTrait,
    IncreseProductQuantityTrait,
    CreateNewCartTrait,
    QuantityLessThanOrderTrait
    ;
    public function addToCart($request){
        // check if there is matching product in dataBase
        $product = $this->getProduct($request->product_id);
        // check if there are proucts less than order quantity or product quantity less than  request of product_quantity
        if(QuantityLessThanOne::quantityLessThanOne($request->product_quantity) 
                            ||$this->quantityLessThanOrder($product->quantity,$request->product_quantity)){
            return ResponseMessage::failedResponse();
        }

        // check if product already exist  in cart Table
        if($this->isProductIdExistINCart($product->id,Auth::id())){
            $alreadyInCart= $this->getCartproduct($product->id,Auth::id());
            $totalOrderQuantity = $request->product_quantity + $alreadyInCart->product_quantity;
            if($this->quantityLessThanOrder($product->quantity,$totalOrderQuantity)){
                return ResponseMessage::failedResponse();
            }
            $this->increaseProductQuantity($alreadyInCart,$request);
            return ResponseMessage::succesfulResponse();
        }else{
            // iff did not exist create new cart
            $this->createNewCart($request);
            return ResponseMessage::succesfulResponse();
        }
    }

}
<?php
namespace App\services\Cart;

use App\Models\Inventory;
use App\services\ResponseMessage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\Cart\CreateNewCartTrait;
use App\Http\Traits\Cart\GetCartproductTrait;
use App\Http\Traits\Cart\QuantiyLessThanOneTrait;
use App\Http\Traits\Cart\TotalOrderQuantityTrait;
use App\Http\Traits\Cart\QuantityLessThanOrderTrait;
use App\Http\Traits\Cart\IsProductIdExistINCartTrait;
use App\Http\Traits\Product\IncreseProductQuantityTrait;

class AddToCartService {
    use GetCartproductTrait,
    IncreseProductQuantityTrait,
    CreateNewCartTrait,
    QuantityLessThanOrderTrait,
    QuantiyLessThanOneTrait,
    TotalOrderQuantityTrait
    ;
    private $inventory;
    private $alreadyInCart; 
    private $totalOrderQuantity;
    public function addToCart($request){
         $this->inventory = Inventory::where('product_id',$request->product_id)->select('quantity')->first();
        // check if there are proucts less than order quantity or product quantity less than  request of product_quantity
        if(!$this->inventory|| $this->quantityLessThanOne($request->quantity) 
                    ||$this->quantityLessThanOrder($this->inventory->quantity,$request->quantity)){
            return ;
        }
        // check if product already exist  in cart Table
        $this->alreadyInCart= $this->getCartproduct($request->product_id,Auth::id());
        if(empty($this->alreadyInCart)){
            return $this->createNewCart($request);
        }

        $this->totalOrderQuantity = $this->totalOrderQuantity($request->quantity,$this->alreadyInCart->quantity);
        if($this->quantityLessThanOrder($this->inventory->quantity,$this->totalOrderQuantity)){
            return ;
        }
        $this->increaseProductQuantity($this->alreadyInCart,$request);
        $this->alreadyInCart->save();
        return ResponseMessage::succesfulResponse();
    
    }
}
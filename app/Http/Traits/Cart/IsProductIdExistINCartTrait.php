<?php

namespace App\Http\Traits\Cart;

use App\Models\Cart;

trait  IsProductIdExistINCartTrait
{
    protected function isProductIdExistINCart($product_id,$user_id){
        return Cart::ProductId($product_id)->userId($user_id)->exists();
    }
    

}

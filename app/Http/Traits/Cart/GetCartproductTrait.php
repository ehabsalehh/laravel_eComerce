<?php

namespace App\Http\Traits\Cart;

use App\Models\Cart;

trait GetCartproductTrait
{
    protected function getCartproduct($product_id,$user_id){
        return Cart::ProductId($product_id)->userId($user_id)->first();
     }

    }

<?php

namespace App\Http\Traits\Cart;

use App\Models\Cart;

trait GetCartproductTrait
{
    protected function getCartproduct($product_id,$customer_id){
        return Cart::ProductId($product_id)->customerId($customer_id)->first();
     }

    }

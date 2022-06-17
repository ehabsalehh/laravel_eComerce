<?php

namespace App\Http\Traits\Cart;

use App\Models\Cart;

trait  IsProductIdExistINCartTrait
{
    protected function isProductIdExistINCart($product_id,$customer_id){
        return Cart::ProductId($product_id)->customerId($customer_id)->exists();
    }
    

}

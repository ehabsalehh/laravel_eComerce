<?php

namespace App\Http\Traits\Cart;

trait TotalOrderQuantityTrait
{
     public function totalOrderQuantity($requestQuantity,$quantity){
        return $requestQuantity + $quantity;
     }

}

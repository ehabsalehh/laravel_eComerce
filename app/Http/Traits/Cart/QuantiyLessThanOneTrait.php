<?php

namespace App\Http\Traits\Cart;

trait QuantiyLessThanOneTrait
{
    public  function quantityLessThanOne($number){
        return $number <1;
    }

}

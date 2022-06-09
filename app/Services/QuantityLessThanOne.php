<?php

namespace App\Services;

class QuantityLessThanOne
{
    public static function quantityLessThanOne($number){
        return $number <1;
    }
}

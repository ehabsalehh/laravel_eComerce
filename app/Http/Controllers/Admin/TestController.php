<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Traits\Order\CalculateOrderPriceTrait;
use Helper;

class TestController extends Controller
{
    use CalculateOrderPriceTrait;
    public function calculateTotalPrice(){
        return Helper::orderPrice();
        // return Helper::subTotal();

        // return $this->calculateOrderPrice();
    }


}

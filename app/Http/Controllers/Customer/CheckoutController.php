<?php

namespace App\Http\Controllers\Customer;
use App\services\Order\placeOrderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoredOrderRequest;

class CheckoutController extends Controller
{
    private $placeOrder;

public function placeOrder(StoredOrderRequest $request,placeOrderService $placeOrder){
    $this->placeOrder = $placeOrder;
    return $this->placeOrder->placeOrder($request);
}
          
}

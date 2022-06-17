<?php

namespace App\Http\Controllers\Customer;
use App\services\Order\placeOrderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoredOrderRequest;

class CheckoutController extends Controller
{
public function placeOrder(StoredOrderRequest $request){
    $palceOrder = new placeOrderService();
    return $palceOrder->placeOrder($request);
}        
}

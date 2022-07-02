<?php

namespace App\Http\Controllers\Customer;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoredOrderRequest;
use App\services\Order\placeOrderService;
use App\Services\Order\ProccessTransactionService;

class CheckoutController extends Controller
{
    
    private $placeOrder;
    public function couponStore(Request $request){
        $coupon=Coupon::code($request->code)->status('active')->first();
       return  isset($coupon)?session()->put('couponPercent', $coupon->percent):"coupon invalid";
        // session()->put('couponPercent', $coupon->percent);
    }

    public function placeOrder(StoredOrderRequest $request,placeOrderService $placeOrder){
        $this->placeOrder = $placeOrder;
        return $this->placeOrder->placeOrder($request);
    }
    public function coupon_Store(Request $request){
        $coupon=Coupon::code($request->code)->status('active')->first();
        if($coupon){
            session()->put('couponPercent', $coupon->percent);
        }
        return to_route('createTransaction');
    }
          
}

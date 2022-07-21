<?php

namespace App\Http\Controllers\Customer\Checkout;
use Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee\Order\Coupon;
use App\Models\Employee\Order\Shipping;
use App\Http\Requests\StoredOrderRequest;
use App\services\Customer\Checkout\placeOrderService;
use App\services\Customer\Checkout\Cart\CartTotalPrice;
class CheckoutController extends Controller
{ 
    private $placeOrder;
    private $shippings;
    private $orderPrice;
    public function view(CartTotalPrice $orderPrice){
        $this->orderPrice = $orderPrice;
        $this->shippings= Shipping::orderByDesc('id')->get();
        return view('Checkout')
                ->with([
                    'shippings'=>$this->shippings,
                    'orderPrice'=>$this->orderPrice->orderPrice()
                ]);
    }
    public function placeOrder(Request $request,placeOrderService $placeOrder){
        $this->placeOrder = $placeOrder;
        return $this->placeOrder->placeOrder($request);
    }
    public function couponStore(Request $request){
        $coupon=Coupon::code($request->code)->status('active')->firstOrFail();
        session()->put('couponPercent', $coupon->percent);
        return redirect()->intended('viewCheckOut'); 

    }
          
}

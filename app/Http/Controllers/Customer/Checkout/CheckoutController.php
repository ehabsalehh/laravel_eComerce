<?php

namespace App\Http\Controllers\Customer\Checkout;
use App\Models\Coupon;
use App\Models\Employee\Order\Shipping;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoredOrderRequest;
use App\services\Order\placeOrderService;
use Helper;
class CheckoutController extends Controller
{
    
    private $placeOrder;
    private $shippings;
    private $orderPrice;
    public function view(){
        $this->orderPrice = Helper::orderPrice();
        $this->shippings= Shipping::orderByDesc('id')->get();
        return view('Checkout')->with(['shippings'=>$this->shippings,'orderPrice'=>$this->orderPrice]);

    }
    

    public function placeOrder(StoredOrderRequest $request,placeOrderService $placeOrder){
        $this->placeOrder = $placeOrder;
        return $this->placeOrder->placeOrder($request);
    }
    public function couponStore(Request $request){
        $coupon=Coupon::code($request->code)->status('active')->firstOrFail();
        session()->put('couponPercent', $coupon->percent);
        return to_route('viewCheckOut');
    }
          
}

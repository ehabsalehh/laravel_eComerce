<?php
namespace App\Services\Customer\Checkout;

use App\Enums\Employee\Order\OrderStatus;
use App\Enums\Employee\Order\PaymentMethod;
use App\Enums\Employee\Order\PaymentStatus;
use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\Customer\Checkout\Cart;
use App\Models\Customer\Checkout\Order;
use App\Models\Employee\Order\Shipping;
use Illuminate\Support\Facades\Redirect;
use App\Models\Customer\Checkout\Payment;
use App\Notifications\OffersNotification;
use App\Models\Customer\Checkout\OrderItem;
use Illuminate\Support\Facades\Notification;


class placeOrderService{
    private $payment;
    public function placeOrder($request){     
        try {
            DB::beginTransaction();
            $cartItems = Cart::customerId(auth()->id())->get();
            if(empty($cartItems)){return to_route('viewCheckOut');}
            $order =$this->CreateOrder($request);
            $cartItems->map(function($item)use($order){
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id'=>$item->product_id,
                    'customer_id'=>$item->customer_id,
                    'quantity'=>$item->quantity,
                ]);
            });
                
            $this->destroyCart($cartItems);
            $payment = $this->paymentMode()[request()->payment_mode];
            $payment['order_id']=$order->id;
            $payment['amount']=$order->total;
            $payment['customer_id']=auth()->id();
            Payment::create($payment);
            $admin=Admin::get();
            $details=[
                'title'=>'New order created',
            ];
            Notification::send($admin, new OffersNotification($details));
            session()->forget('couponPercent');           
            DB::commit();
            request()->session()->flash('success','order successfully applied');
            return Redirect::back();
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }  
    }
    private function paymentMode():Collection{
        return collect([
                'paidWithPaypal' => $this->paidPayment(),
                'placeOrder' =>$this->unPaidPayment()
        ]);  
    }
    private function unPaidPayment():array
    {
        $payment = [];
        $payment['method']=PaymentMethod::Cod;
        $payment['status']=PaymentStatus::Unpaid;
        return $payment;
    }
    private function paidPayment():array
    {
        $payment = [];
        $payment['method']=PaymentMethod::Paypal;
        $payment['status']=PaymentStatus::Paid;
        return $payment;
    }

    private function destroyCart(){
        $CartIds = Cart::customerId(auth()->id())->pluck('id');
        Cart::whereIn('id',$CartIds)->delete();
    }
    private function CreateOrder($request){
        $data = $request->validate([
            'shipping_id'=>['exists:shippings,id'],
        ]);
        $data['customer_id'] = auth()->id();  
        $data['order_number'] ='ORD-'.strtoupper(Str::random(10));
        $data['status'] = OrderStatus::New;
        $Shipping =Shipping::where('id', $request->shipping_id)->select('price')->first();
        $shippingPrice= $Shipping->price;
        $data['coupon'] =$request->coupon;
        $data['sub_total'] = $request->sub_total +$shippingPrice;    
        $data['total_discount'] = $request->total_discount;
        $data['total'] =$request->total+$shippingPrice;
        return Order::create($data);
    }
    
}
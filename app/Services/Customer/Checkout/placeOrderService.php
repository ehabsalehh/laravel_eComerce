<?php
namespace App\services\Order;
use App\Models\Admin\Admin;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer\Checkout\Cart;
use App\Models\Customer\Checkout\Order;
use App\Models\Employee\Order\Shipping;
use App\Models\Customer\Checkout\Payment;
use App\Notifications\OffersNotification;
use App\Models\Customer\Checkout\OrderItem;
use Illuminate\Support\Facades\Notification;
class placeOrderService{

        public function placeOrder($request){
        try {
            DB::beginTransaction();
            $order =$this->CreateOrder($request);
            $cartItems = Cart::customerId(Auth::id())->get();
            $cartItems->map(function($item)use($order){
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id'=>$item->product_id,
                    'customer_id'=>$item->customer_id,
                    'quantity'=>$item->quantity,
                ]);
            });     
            $this->destroyCart($cartItems);
            $payment= $this->unPaidPayment(); 
            if(request()->payment_mode = 'paid with paypal'){
                $payment= $this->paidPayment();
            }
            $payment['order_id']=$order->id;
            $payment['amount']=$order->total;
            $payment['customer_id']=Auth::id();
            Payment::create($payment);
            $admin=Admin::get();
            $details=[
                'title'=>'New order created',
            ];
            Notification::send($admin, new OffersNotification($details));
            session()->forget('couponPercent');           
            DB::commit();
            request()->session()->flash('success','order successfully applied');
            return to_route('viewCheckOut');
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }  
    }
    private function unPaidPayment()
    {
        $payment = [];
        $payment['method']='cod';
        $payment['status']='Unpaid';
        return $payment;
    }
    private function paidPayment()
    {
        $payment = [];
        $payment['method']='paypal';
        $payment['status']='paid';
        return $payment;
    }

    private function destroyCart($cartItems){
        Cart::customerId(Auth::id())->pluck('id');
        Cart::whereIn('id',$cartItems)->delete();
    }
    private function CreateOrder($request){
        $data= $request->validated();
        $data['customer_id'] = Auth::id();  
        $data['order_number'] ='ORD-'.strtoupper(Str::random(10));
        $data['status'] = 'new';
        $Shipping =Shipping::where('id', $request->shipping_id)->select('price')->first();
        $shippingPrice= $Shipping->price;
        $data['coupon'] =$request->coupon;
        $data['sub_total'] = $request->sub_total +$shippingPrice;    
        $data['total_discount'] = $request->total_discount;
        $data['total'] =$request->total+$shippingPrice;
        return Order::create($data);
    }
    
}
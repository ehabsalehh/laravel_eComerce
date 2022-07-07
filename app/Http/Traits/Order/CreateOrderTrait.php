<?php
namespace App\Http\Traits\Order;

use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;;



trait CreateOrderTrait{
    use 
    OrderShippingTrait
    ;
    protected function CreateOrder($request){
        $data= $request->validated();
        $data['customer_id'] = Auth::id();  
        $data['order_number'] ='ORD-'.strtoupper(Str::random(10));
        $data['status'] = 'new';
        $shippingPrice= $this->orderShipping($request)->price;
        $data['coupon'] =$request->coupon;
        $data['sub_total'] = $request->sub_total +$shippingPrice;    
        $data['total_discount'] = $request->total_discount;
        $data['total'] =$request->total+$shippingPrice;
        return  Order::create($data);
    }

}
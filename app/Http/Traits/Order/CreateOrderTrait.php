<?php
namespace App\Http\Traits\Order;

use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;;
use App\Http\Traits\Cart\SubTotalPriceTrait;



trait CreateOrderTrait{
    use 
    OrderHasShippingTrait,
    SubTotalPriceTrait
;
    protected function CreateOrder($request){
        $data= $request->validated();
        $data['customer_id'] = Auth::id();  
        $data['order_number'] ='ORD-'.strtoupper(Str::random(10));
        $data['sub_total'] = $request->sub_total;    
        $data['total_discount'] = $request->total_discount;
        $shippingPrice= $this->orderHasShipping($request);
        $data['total'] =$request->total+$shippingPrice ;
        return  Order::create($data);

        // $calculateTotal= $this->subTotal();
        // if(isset($calculateTotal)){
        //     $subTotal =$calculateTotal->sub_total;
        //     $couponPercent = session('couponPercent');
        //     $couponDiscountValue= isset($couponPercent)?session()->get('couponPercent')/100*$subTotal:0;
        //     $total_discount =$calculateTotal->total_disc+$couponDiscountValue;
        //     $total = $subTotal - $total_discount;
            
        //     if(request()->has('shipping_id') ){
        //         $shipping =Shipping::where('id', request()->shipping_id)->select('price')->first();
        //         $data['total'] =$total +$shipping->price ;
        //     }else{
        //         $data['total'] = $total;
        //     }
        //     $data['sub_total'] = $subTotal;    
        //     $data['total_discount'] = $total_discount;
        //    
        //     $data['status']="new";

        // return  Order::create($data);
         
        // }

    }

}
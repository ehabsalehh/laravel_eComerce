<?php
namespace App\Http\Traits\Order;

use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\Cart\CartTotalPriceTrait;
use App\Http\Traits\Cart\SubTotalPriceTrait;
use App\Http\Traits\Cart\TotalPriceTrait;
use App\Http\Traits\Cart\TotalPriceWithDiscountTrait;
use App\Models\Product;
use App\Models\Shipping;
use App\services\ResponseMessage;

trait CreateOrderTrait{
    use 
    OrderHasShippingTrait,
    // TotalPriceTrait,
    SubTotalPriceTrait
;
    protected function CreateOrder($request){
        $data= $request->validated();
        $data['customer_id'] = Auth::id();  
        $data['order_number']='ORD-'.strtoupper(Str::random(10));
        // toatl = subtotal - disc  && if order has shipping add shipping price to total
        $calculateTotal= $this->subTotal();
        $total_discount =$calculateTotal->total_disc;
        $subTotal =$calculateTotal->sub_total;
        $total = $subTotal - $total_discount;
        $hasShipping = $this->orderHasShipping($request);
        $data ['sub_total'] = $subTotal;    
        $data ['total_discount'] = $total_discount;
        $data ['total'] = $hasShipping?$hasShipping + $total:$total;

        // $data ['total'] = $this->orderHasShipping($request)
        //     ?$this->orderHasShipping($request)+($this->subTotal()->sub_total - $this->subTotal()->total_disc)
        //     :$this->subTotal()->sub_total - $this->subTotal()->total_disc;    
         return  Order::create($data);
    }

}
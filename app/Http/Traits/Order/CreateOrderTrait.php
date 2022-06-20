<?php
namespace App\Http\Traits\Order;

use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\Cart\CartTotalPriceTrait;
use App\Models\Product;
use App\Models\Shipping;
use App\services\ResponseMessage;

trait CreateOrderTrait{
    use 
    OrderHasShippingTrait;
    protected function CreateOrder($request){
        $productwithnotDisount= Product::where('id',$request->product_id)->where('discount_id','<>',null)->first();
        $data= $request->validated();
        $data['customer_id'] = Auth::id();  
        $data['order_number']='ORD-'.strtoupper(Str::random(10));
        
        if(empty($productwithnotDisount)){
            // products With Dicounts   
            $data ['sub_total'] = $this->total_Price()->sub_total;    
            $data ['total_discount'] = $this->total_Price()->total_disc;
            $data ['total'] = $this->orderHasShipping($request)??$this->total_Price()->total;    
        return  Order::create($data);
        }else{
            $data ['total'] = $this->orderHasShipping($request)??$this->total_Price()->total;
            return Order::create($data);
        }
    }

}
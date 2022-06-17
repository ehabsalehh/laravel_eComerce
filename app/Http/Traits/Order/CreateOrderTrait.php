<?php
namespace App\Http\Traits\Order;

use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\Cart\CartTotalPriceTrait;

trait CreateOrderTrait{
    use CartTotalPriceTrait;
    protected function CreateOrder($request){
        $data= $request->all();
        $data['customer_id'] = Auth::id();
        $data['order_number']='ORD-'.strtoupper(Str::random(10));
        $data ['total_price'] = $this->totalPrice()->total_price;
        return Order::create($data);
    }
}
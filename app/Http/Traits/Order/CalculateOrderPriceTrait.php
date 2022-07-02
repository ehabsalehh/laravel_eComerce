<?php

namespace App\Http\Traits\Order;

use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\Cart\SubTotalPriceTrait;
use App\Http\Traits\Order\OrderHasShippingTrait;

trait CalculateOrderPriceTrait
{
    use
    OrderHasShippingTrait,
    SubTotalPriceTrait
    ;
    public function calculateOrderPrice()
    {
        
        $calculateTotal= $this->subTotal();
        if(isset($calculateTotal)){
            $subTotal =$calculateTotal->sub_total;
            $couponPercent = session('couponPercent');
            $couponDiscountValue= isset($couponPercent)?session()->get('couponPercent')/100*$subTotal:0;
            $total_discount =$calculateTotal->total_disc+$couponDiscountValue;
            $total = $subTotal - $total_discount;
            //    $Shipping=  Customer::where('id',Auth::id())->where('city','<>','cairo')->first();
           $customerCity=  Customer::where('id',Auth::id())->select('city')->first();
            $ShippingCitiesPrice = [
                'cairo' => 0,
                'mansoura' => 20,
                'default' => 30
            ];
            // return $customerCity->city;
            if(isset($ShippingCitiesPrice[$customerCity->city])){
                $shippngPrice = $ShippingCitiesPrice[$customerCity->city];
            }else{
                $shippngPrice = $ShippingCitiesPrice['default'];
            }   
            $data['total'] =$total + $shippngPrice ;
            $data['sub_total'] = $subTotal;    
            $data['total_discount'] = $total_discount;
            // $data['customer_id'] = Auth::id();  
            // $data['order_number'] ='ORD-'.strtoupper(Str::random(10));
            // $data['status']="neww";
            return $data;
        }
    }

}

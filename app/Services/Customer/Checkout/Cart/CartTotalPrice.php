<?php

namespace App\services\Customer\Checkout\Cart;
use Illuminate\Support\Facades\DB;
use App\Models\Employee\Order\Shipping;

class CartTotalPrice
{
    public  function subTotal(){
        $CartCustomer= DB::table('carts')->where('customer_id',auth()->id())->first();
        if(!isset($CartCustomer)){return ;}
            $cartItems = DB::table('carts')
            ->where('customer_id',auth()->id());
                return  DB::table('products')
                ->joinSub($cartItems, 'carts', function ($join) {
                    $join->on('products.id', '=', 'carts.product_id');
                    })
                ->leftjoin('discounts','discounts.id','products.discount_id')        
                    ->select(////price plus tax value
                    DB::raw('SUM((price + (tax/100) * price)*quantity) as sub_total'), 
                    //discount value =  percent /100 * subtotal
                    DB::raw('SUM(IFNULL(percent/100 * (price + (1/ tax) * price),0) *quantity) as total_disc'),
                    )
                    ->groupBy('customer_id')
                    ->first();
    } 
    public  function orderPrice(){
        $calculateTotal= $this->subTotal();
        if(empty($calculateTotal)){return;}
            $subTotal =$calculateTotal->sub_total;
            $couponDiscountValue = session()->get('couponPercent')/100*$subTotal;
            $total_discount =$calculateTotal->total_disc+$couponDiscountValue;
            $total = $subTotal - $total_discount;
            $data['sub_total'] = $subTotal;
            $data['total_discount'] = $total_discount;
            $data['total'] = $total;    
            $data['coupon'] = $couponDiscountValue;
            return $data;
    }
    public static function Shipping(){
        return Shipping::orderByDesc('id')->get();
    }
    public static function getShippingPrice($id){
        return Shipping::where('id',$id)->select('price')->first();
    }

}

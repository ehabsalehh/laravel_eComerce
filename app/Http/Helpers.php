<?php

use App\Models\Shipping;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Helper{
    public static function subTotal(){
        $cartHasproduct= DB::table('carts')->where('customer_id',Auth::id())->exists();
        if($cartHasproduct){
            $cartItems = DB::table('carts')
            ->where('customer_id',Auth::id());
                return  DB::table('products')
                ->joinSub($cartItems, 'carts', function ($join) {
                    $join->on('products.id', '=', 'carts.product_id');
                    })
                ->leftjoin('discounts','discounts.id','products.discount_id')        
                    ->select(
                    DB::raw('SUM((price + (tax/100) * price)*quantity) as sub_total'),//price plus tax value 
                    //dicecount value =  percent /100 * subtotal
                    DB::raw('SUM(IFNULL(percent/100 * (price + (1/ tax) * price),0) *quantity) as total_disc'),
                    )
                    ->groupBy('customer_id')
                    ->first();
        }
    } 
    public static function orderPrice(){
        $calculateTotal= self::subTotal();
        if(isset($calculateTotal)){
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
    }
    public static function Shipping(){
        return Shipping::orderByDesc('id')->get();
    }
    public static function getShippingPrice($id){
        return Shipping::where('id',$id)->select('price')->first();
    }
}
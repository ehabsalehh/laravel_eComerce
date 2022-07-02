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
        // IFNULL(sc.shippingperkg,0)
            return  DB::table('products')
            ->joinSub($cartItems, 'carts', function ($join) {
                $join->on('products.id', '=', 'carts.product_id');
                })
            ->leftjoin('discounts','discounts.id','products.discount_id')        
                ->select(
                DB::raw('SUM((price + (1/ tax) * price)*quantity) as sub_total'),//price plus tax value 
                DB::raw('SUM(IFNULL(1/ percent * price,0) *quantity) as total_disc'),//perecent value
                // DB::raw('SUM((price + (1/ tax) * price)*quantity)-(IFNULL(1/ percent * price,0) *quantity))) as total')
                )
                ->groupBy('customer_id')
                ->first();
        }
    } 
    public static function orderPrice(){
        $calculateTotal= self::subTotal();
        if(isset($calculateTotal)){
            $subTotal =$calculateTotal->sub_total;
            $couponPercent = session('couponPercent');
            $couponDiscountValue= isset($couponPercent)?session()->get('couponPercent')/100*$subTotal:0;
            
            $total_discount =$calculateTotal->total_disc+$couponDiscountValue;
            $total = $subTotal - $total_discount;
            
            if(request()->has('shipping_id') ){
                $shipping =Shipping::where('id', request()->shipping_id)->select('price')->first();
                $data['total'] =$total +$shipping->price ;
            }else{
                $data['total'] = $total;
            }
            $data['sub_total'] = $subTotal;    
            $data['total_discount'] = $total_discount;

        return collect($data);
        }
    }
    public static function Shipping(){
        return Shipping::orderByDesc('id')->get();
    }
    public static function getShippingPrice($id){
        return Shipping::where('id',$id)->select('price')->first();
    }
}
<?php
namespace App\Http\Traits\Cart;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

trait SubTotalPriceTrait{

    protected function subTotal(){
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
        // DB::raw('SUM((price + (1/ tax) * price)*quantity) -(IFNULL(1/ percent * price,0) *quantity) as total')
        )
        ->groupBy('customer_id')
        ->first();

        // return collect($total)->toArray();
        // total =  sub_total - total_disc

     }

}

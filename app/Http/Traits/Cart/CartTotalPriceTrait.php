<?php
namespace App\Http\Traits\Cart;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

trait CartTotalPriceTrait{
    protected function total_Price(){
        $cartItems = DB::table('carts')
        ->where('customer_id',Auth::id());

       return  $products = DB::table('products')
       ->join('discounts','discounts.id','products.discount_id')
        ->joinSub($cartItems, 'carts', function ($join) {
        $join->on('products.id', '=', 'carts.product_id');
        })
        ->select(
        DB::raw('SUM((price + (1/ tax) * price)) as sub_total'),
        DB::raw('SUM(1/ tax * price) as total_disc'),
        DB::raw('SUM(((price + (1/ tax) * price) - (1/ percent) * (price + (1/ tax) * price))) as total'))
        ->groupBy('customer_id')
        ->first();
     }

}

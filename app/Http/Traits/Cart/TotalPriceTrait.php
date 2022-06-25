<?php

namespace App\Http\Traits\Cart;

use Illuminate\Support\Facades\DB;

trait TotalPriceTrait
{
    protected function total_Price(){
        $cartItems = DB::table('carts')
        ->where('customer_id',auth()->user()->id);

       return DB::table('products')
        ->joinSub($cartItems, 'carts', function ($join) {
        $join->on('products.id', '=', 'carts.product_id');
        })
        // ((price + (1/ tax) * price)*quantity)  - ((1/ percent * price)*quantity)
        ->select(
        // DB::raw('SUM((price + (1/ tax) * price)*quantity) as sub_total'),//price plus tax value 
        // DB::raw('SUM((1/ percent * price)*quantity) as total_disc'),//perecent value
        // sub_total - total_disc
        DB::raw('SUM(((price + (1/ tax) * price)*quantity)) as total'))
        ->groupBy('customer_id')
        ->first();
     }


}

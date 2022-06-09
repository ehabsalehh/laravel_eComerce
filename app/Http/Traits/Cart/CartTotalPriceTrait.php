<?php
namespace App\Http\Traits\Cart;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

trait CartTotalPriceTrait{
    protected function totalPrice(){
        return Cart::userId(Auth::id())->join('products','carts.product_id','products.id')
        ->selectRaw('sum(carts.product_quantity * products.selling_price) as total_price')
        ->first();
     }
}

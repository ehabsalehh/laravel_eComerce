<?php

namespace App\Http\Traits\OrderItem;

use Illuminate\Support\Facades\DB;

trait GetOrderItemsProductTrait
{
    protected function GetOrderItemsProduct($product_id){
        return  DB::table('order_items')->where('product_id',$product_id);
    }

}

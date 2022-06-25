<?php

namespace App\Http\Traits\OrderItem;

use App\Models\Product;

trait GetProductOrderItemTrait
{
    protected function getProductOrderItem($request){
        return Product::where('id',$request->product_id)
            ->with(['orderItems'=>function($query) use($request){
                    $query->where('order_id',$request->order_id)
                    ->where('customer_id',$request->customer_id)
                    ->where('product_id',$request->product_id);
        },'discount','inventory'])->select('products.id','products.price')->first();
   

    }

}

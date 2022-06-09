<?php

namespace App\Http\Traits\Product;

trait IncreseProductQuantityTrait
{
    protected function increaseProductQuantity($product,$request){
        $product->product_quantity = $product->product_quantity+$request->product_quantity;
        $product->save();
    }
}

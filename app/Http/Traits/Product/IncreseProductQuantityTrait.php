<?php

namespace App\Http\Traits\Product;

trait IncreseProductQuantityTrait
{
    protected function increaseProductQuantity($product,$request){
        $product->quantity += $request->quantity;
    }
}

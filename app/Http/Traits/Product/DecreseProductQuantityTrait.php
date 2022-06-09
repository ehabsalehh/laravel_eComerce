<?php

namespace App\Http\Traits\Product;

trait DecreseProductQuantityTrait
{
use GetProductTrait;
protected function decreseProductQuantity($item){
    $product = $this->getProduct($item->product_id);
    $product->quantity = $product->quantity - $item->product_quantity; 
    $product->save();
}
}

<?php

namespace App\Http\Traits\Product;

trait DecreseProductQuantityTrait
{
use GetInventoryTrait;
protected function decreseInventoryQuantity($item){
    $inventory = $this->getInventory($item->product_id);
    $inventory->quantity = $inventory->quantity - $item->quantity; 
    $inventory->save();
}
}

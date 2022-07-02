<?php

namespace App\Http\Traits\Product;

trait DecreseInventoryQuantityTrait
{
use GetInventoryTrait;
protected function decreseInventoryQuantity($item){
    $inventory = $this->getInventory($item->product_id);
    $inventory->quantity -=  $item->quantity; 
    $inventory->save();
}
}

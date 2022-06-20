<?php

namespace App\Http\Traits\Product;

use App\Models\Inventory;

trait GetInventoryTrait
{
    protected function getInventory($product){
        return  Inventory::getInventoryProdut($product)->first();
    }

}

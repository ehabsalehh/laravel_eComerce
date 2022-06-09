<?php

namespace App\Http\Traits\Product;

use App\Models\Product;

trait GetProductTrait
{
    protected function getProduct($id){
        return  Product::Id($id)->first();
    }

}

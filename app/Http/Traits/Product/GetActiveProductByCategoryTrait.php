<?php

namespace App\Http\Traits\Product;

use App\Models\Product;

trait GetActiveProductByCategoryTrait
{
    protected  function getActiveProductByCategory($category_id){
        return Product::getProductByCategory($category_id)
                ->getActiveProduct()->with('category')->get();
    }
}

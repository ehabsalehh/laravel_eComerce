<?php

namespace App\Http\Traits\Product;

use App\Models\Product;

trait GetActiveProductByCategoryTrait
{
    protected  function getActiveProductByCategory($category_id){
        return Product::getProductByCategory($category_id)
                        ->getProductByChildCategory($category_id)
                ->getActiveProduct()
                ->ProductWith()->get();
    }
}

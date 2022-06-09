<?php

namespace App\Http\Traits\Product;

use App\Models\Product;

trait GetPopularProductTrait
{
    protected function getPopularProduct(){
        return  Product::where('popular','popular')->paginate(10);
    }

}

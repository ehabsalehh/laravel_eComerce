<?php

namespace App\Services\Employee\Product;

use App\Models\Employee\Product\Product;

class ActiveProductByCategory
{
    public  function getActiveProduct(){
        $get = $_GET['category_id']??$_GET['child_category_id'];
        return Product::query()
            ->byCategory($get)
            ->orWhere(function ($query)use($get) {
                $query->byChildCategory($get);
            })
            ->active()
            ->ProductWith()
            ->get();
    }

}

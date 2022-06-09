<?php

namespace App\Http\Traits\Category;

use App\Models\Category;

trait GetActiveCategoryTrait
{
    protected function getActiveCategory (){
        return Category::where('status','active');
    }
}

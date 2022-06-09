<?php

namespace App\Http\Traits\Category;

use App\Models\Category;

trait GetPopularCtegoryTrait
{
    protected function getPopularCtegory(){
        return Category::where('popular','popular')->paginate(10);
    }

}

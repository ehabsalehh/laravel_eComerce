<?php

namespace App\Services\Product;

use App\Models\Product;


class ProductGridService
{
    public function productGrid($model){
        $products=Product::query();
        if(!empty($_GET[$model])){
             $slug=explode(',',$_GET[$model]);
            // dd($slug);
            $nameSpace ="App\Models\\$model"; 
            $model_ids= $nameSpace::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            $modelId= $model."_id";
            return $products->whereIn($modelId,$model_ids)
                ->where('status','active')->paginate(9);
        }

    }
}

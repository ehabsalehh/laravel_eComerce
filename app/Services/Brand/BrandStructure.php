<?php

namespace App\Services\Brand;

use App\Models\Brand;
use Illuminate\Support\Str;
use App\services\ResponseMessage;

class BrandStructure
{
    public function brandStructure($request){
        $name= $request->name;
        $slug= Str::slug($name).'-'.date('ymdis');
        $status = $request->status;
        $brand = new BrandData($name,$slug);
        $brand->setBrandStatus(new BrandStatus($status));
        $getStaus= $brand->getBrandStatus();
        $getSlug = $brand->getSlug();
        $getName = $brand->getName();
        return ['name'=>$getName,'slug'=>$getSlug,'status'=>$getStaus];
              
    }

}

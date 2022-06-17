<?php

namespace App\Services\Brand;

use App\Models\Brand;
use App\services\ResponseMessage;

class UpdateBrand
{
    private $brandStructure;
    public function __construct(BrandStructure $brandStructure)
    {
        $this->brandStructure =$brandStructure;
    }
    public function update($request){
        $brand = Brand::findOrFail($request->id);
        $data =$this->brandStructure->brandStructure($request);
        $brand->update($data);
        return ResponseMessage::succesfulResponse();
    }

}

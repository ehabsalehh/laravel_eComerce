<?php

namespace App\Services\Brand;

use App\Models\Brand;
use App\services\ResponseMessage;

class StoreBrand
{
    private $brandStructure;
    public function __construct(BrandStructure $brandStructure)
    {
        $this->brandStructure =$brandStructure;
    }
    public function store($request){
        $data =$this->brandStructure->brandStructure($request);
        Brand::create($data);
        return ResponseMessage::succesfulResponse();
    }

}

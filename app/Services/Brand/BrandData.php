<?php

namespace App\Services\Brand;

use App\Models\Brand;
use Illuminate\Support\Str;
use App\services\ResponseMessage;

class BrandData
{
    private $data;
    public function getData($request){
        $this->data =$request->validated(); 
        $this->data['slug'] = Str::slug($request->name).'-'.date('ymdis');
        return $this->data;
    }

}

<?php

namespace App\Services\Category;

use App\Http\Traits\handleFile\UploadCategoryFileTrait;
use App\Models\Category;
use App\services\ResponseMessage;
use Illuminate\Support\Str;

class StoreCategory
{
    use UploadCategoryFileTrait;
    private $data;
    public function store($request){
        try {
            $this->data= $request->validated();
            $this->data['slug']=Str::slug($request->name).'-'.date('ymdis');
            $this->data['photo'] = $this->uploadCategoryFile($request);
            $this->data['is_parent']=$request->input('is_parent',0);
            Category::create($this->data);
            return ResponseMessage::succesfulResponse();
        } catch (\Throwable $th) {
            throw $th;
        }
     
    }

}

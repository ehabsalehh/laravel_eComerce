<?php

namespace App\Services\Category;

use App\Models\Category;
use Illuminate\Support\Str;

class StoreCategory
{
    private $uploadCategoryFile;
    private $data;
    private $slug;
    public function store($request,UploadCategoryFile $uploadCategoryFile){
        try {
            $this->uploadCategoryFile = $uploadCategoryFile;
            $this->data= $request->all();
            $this->slug= Str::slug($request->name).'-'.date('ymdis');
            $this->data['slug']=$this->slug;
            $this->data['photo'] = $this->uploadCategoryFile->getFileName();
            $this->data['is_parent']=$request->input('is_parent',0);
            Category::create($this->data);       
        } catch (\Throwable $th) {
            throw $th;
        }
     
    }

}

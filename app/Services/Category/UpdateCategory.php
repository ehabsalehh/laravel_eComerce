<?php

namespace App\Services\Category;

use App\Http\Traits\handleFile\UpdateCategoryPhotoTrait;
use App\Models\Category;
use App\services\ResponseMessage;

class UpdateCategory
{
    use UpdateCategoryPhotoTrait;
     private $data;
    public function update($request,Category $category){
        try {
            $this->data= $request->validated();
            $this->data['photo'] = $this->updateCategoryPhoto($request,$category->photo);
            $category->update($this->data);    
            return ResponseMessage::succesfulResponse();   
        } catch (\Throwable $th) {
            throw $th;
        }
     
    }

}

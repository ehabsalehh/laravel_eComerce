<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Services\Category\UploadCategoryFile;
use App\services\ResponseMessage;

class UpdateCategory
{
    private $updateCategoryPhoto;
     private $model;
     private $data;
     private $fileName;
    public function update($request,UpdateCategoryPhoto $updateCategoryPhoto){
        try {
            $this->model = Category::findOrFail($request->id);
            $this->updateCategoryPhoto =$updateCategoryPhoto;
            $this->fileName = $this->updateCategoryPhoto->updateCategoryPhoto($request,$this->model->photo);
            $this->data= $request->all();
            $this->data['photo'] = $this->fileName;
            $this->model->update($this->data);    
            return ResponseMessage::succesfulResponse();   
        } catch (\Throwable $th) {
            throw $th;
        }
     
    }

}

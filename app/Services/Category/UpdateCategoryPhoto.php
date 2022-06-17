<?php

namespace App\Services\Category;

use App\Http\Traits\handleFile\DeleteFileTrait;
use App\Http\Traits\handleFile\UploadFileTrait;
use App\Models\Category;

class UpdateCategoryPhoto
{
    use DeleteFileTrait,
    UploadFileTrait
;
    private $currentImage;
    private $newImage;
    public function updateCategoryPhoto($request,$photo){
        if($request->hasFile('photo')){
            $this->currentImage = $photo;
            $this->setNewImage($request);
            $this->changeLocalPhoto($request);
            return  ($this->currentImage !== $this->newImage) ? $this->newImage : $this->currentImage;
           }        
    }
    private function changeLocalPhoto($request){
        if($this->currentImage !== $this->newImage){
            $this->deleteFile($this->currentImage,'Categories');
            $this->uploadFile($request,'photo','Categories');
        }
    }
    private function setNewImage($request){
        $this->newImage = $request->file('photo')->getClientOriginalName();
    } 
}

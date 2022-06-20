<?php

namespace App\Http\Traits\handleFile;

trait ChangeCategoryLocalFileTrait
{
    use
    DeleteFileTrait,
    UploadFileTrait;
    public function changeCategoryLocalFile($request,$currentImage,$newImage){
        if($currentImage !== $newImage){
            $this->deleteFile($currentImage,'Categories');
            $this->uploadFile($request,'photo','Categories');
        }
    }

}

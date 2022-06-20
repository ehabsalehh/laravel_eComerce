<?php

namespace App\Http\Traits\handleFile;

trait ChangeProductLocalFileTrait
{
    use
    DeleteFileTrait,
    UploadFileTrait;
    public function changeProductLocalFile($request,$currentImage,$newImage){
        if($currentImage !== $newImage){
            $this->deleteFile($currentImage,'Products');
            $this->uploadFile($request,'photo','Products');
        }
    }

}

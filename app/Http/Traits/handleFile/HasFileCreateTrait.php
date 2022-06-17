<?php

namespace App\Http\Traits\handleFile;

trait HasFileCreateTrait
{
    use UploadFileTrait;
    protected function hasFileCreate($request,$fileName,$folder){
        $this->uploadFile($request,$fileName,$folder);
        return   $request->file($fileName)->getClientOriginalName();
   
    }

}

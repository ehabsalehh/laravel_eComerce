<?php

namespace App\Http\Traits\handleFile;

trait HasOptionalFileCreateTrait
{
    use UploadFileTrait;
    protected function hasOptionalFileCreate($request,$fileName,$folder){
        if($request->hasfile($fileName)){
            $this->uploadFile($request,$fileName,$folder);
            return   $request->file($fileName)->getClientOriginalName();

        }
    }

}

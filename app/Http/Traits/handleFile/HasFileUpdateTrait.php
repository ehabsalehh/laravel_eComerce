<?php

namespace App\Http\Traits\handleFile;

trait HasFileUpdateTrait
{
    use DeleteFileTrait,
        UploadFileTrait
    ;
    public function hasFileUpdate($request,$modelAttribute,$fileName,$folder){
        $file_name_new = $request->file($fileName)->getClientOriginalName();
        if($modelAttribute !== $file_name_new){
            $this->deleteFile($modelAttribute,$folder);
            $this->uploadFile($request,$fileName,$folder);
        }
        return  ($modelAttribute !== $file_name_new) ? $file_name_new : $modelAttribute;
        
    }

}

<?php

namespace App\Http\Traits\handleFile;

trait HasOptionalFileUpdateTrait
{
    use DeleteFileTrait,
        UploadFileTrait
    ;
    public function hasOptionalFileUpdate($request,$modelAttribute,$fileName,$folder){
        if($request->hasFile($fileName)){
            $file_name_new = $request->file($fileName)->getClientOriginalName();
            if($modelAttribute !== $file_name_new){
                $this->deleteFile($modelAttribute,$folder);
                $this->uploadFile($request,$fileName,$folder);
            }
            return  ($modelAttribute !== $file_name_new) ? $file_name_new : $modelAttribute;
           }
    }

}

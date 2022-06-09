<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

trait AttachFilesTrait
{
    public function uploadFile($request,$name,$folder)
    {
        $file_name = $request->file($name)->getClientOriginalName();
        $request->file($name)->storeAs('attachments/',$folder.'/'.$file_name,'upload_attachments');

    }

    public function deleteFile($name,$folder)
    {
        $exists = Storage::disk('upload_attachments')->exists('attachments/'.$folder.'/'.$name);

        if($exists)
        {
            Storage::disk('upload_attachments')->delete('attachments/'.$folder.'/'.$name);
        }
    }
    public function createHasFile($request,$fileName,$folder){
            if($request->hasfile($fileName)){
                $this->uploadFile($request,$fileName,$folder);
                return   $request->file($fileName)->getClientOriginalName();

            }
    }
    public function UpdateHasFile($request,$modelAttribute,$fileName,$folder){
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

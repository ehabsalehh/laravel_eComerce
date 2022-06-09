<?php

namespace App\Http\Traits\handleFile;

trait UploadFileTrait
{
    protected function uploadFile($request,$name,$folder)
    {
        $file_name = $request->file($name)->getClientOriginalName();
        $request->file($name)->storeAs('attachments/',$folder.'/'.$file_name,'upload_attachments');

    }
}

<?php

namespace App\Http\Traits\handleFile;

trait UploadEmployeeFileTrait
{
    public function uploadEmployeeFile($request)
    {
        $fileName = $request->file('photo')->getClientOriginalName(); 
        $request->file('photo')->storeAs('attachments/Employees/'.$fileName,'upload_attachments');
        return $fileName;
    }

}

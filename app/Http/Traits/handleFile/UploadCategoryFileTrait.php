<?php

namespace App\Http\Traits\handleFile;

trait UploadCategoryFileTrait
{
    public function uploadCategoryFile($request)
    {
        $fileName = $request->file('photo')->getClientOriginalName(); 
        $request->file('photo')->storeAs('attachments/Categories/'.$fileName,'upload_attachments');
        return $fileName;
    }

}

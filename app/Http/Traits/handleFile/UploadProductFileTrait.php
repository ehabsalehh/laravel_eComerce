<?php

namespace App\Http\Traits\handleFile;

trait UploadProductFileTrait
{
    public function uploadProductFile($request)
    {
        $fileName = $request->file('photo')->getClientOriginalName(); 
        $request->file('photo')->storeAs('attachments/Products',$fileName,'upload_attachments');
        return $fileName;
    }

}

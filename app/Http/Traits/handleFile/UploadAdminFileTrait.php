<?php

namespace App\Http\Traits\handleFile;

trait UploadAdminFileTrait
{
    public function uploadAdminFile($request)
    {
        $fileName = $request->file('photo')->getClientOriginalName(); 
        // return $request->file('photo')->store('public/Admins');
         $request->file('photo')->storeAs('attachments/Admins',$fileName,'upload_attachments');
        // $request->file('photo')->store('pup/Admins/'.$fileName,'upload_attachments');

        return $fileName;
    }

}

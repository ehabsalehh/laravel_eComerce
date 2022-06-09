<?php

namespace App\Http\Traits\handleFile;

use Illuminate\Support\Facades\Storage;

trait DeleteFileTrait
{
    protected function deleteFile($name,$folder)
    {
        $exists = Storage::disk('upload_attachments')->exists('attachments/'.$folder.'/'.$name);

        if($exists)
        {
            Storage::disk('upload_attachments')->delete('attachments/'.$folder.'/'.$name);
        }
    }

}

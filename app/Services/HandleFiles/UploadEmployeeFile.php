<?php

namespace App\Services\HandleFiles;

use function PHPUnit\Framework\returnSelf;

class UploadEmployeeFile
{
    private $fileName;
    public function __construct($request)
    {
        $this->fileName = $request->file('photo')->getClientOriginalName(); 
        $request->file('photo')->storeAs('attachments/Employees/'.$this->fileName,'upload_attachments');
    }
    public function getFileName(){
        return $this->fileName;
    }
    
}

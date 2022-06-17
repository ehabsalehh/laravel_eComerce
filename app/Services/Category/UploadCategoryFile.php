<?php

namespace App\Services\Category;

class UploadCategoryFile
{
    private $fileName;
    public function __construct($request){
        if($request->hasfile('photo')){
            $this->fileName = $request->file('photo')->getClientOriginalName(); 
            $request->file('photo')->storeAs('attachments/Categories/'.$this->fileName,'upload_attachments');
        };
    }
    public function getFileName(){
        return $this->fileName;
    }

}

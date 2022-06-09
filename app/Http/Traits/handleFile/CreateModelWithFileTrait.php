<?php

namespace App\Http\Traits\handleFile;

use App\services\ResponseMessage;

trait CreateModelWithFileTrait
{
    use HasFileCreateTrait;
    protected function createModelWithFile($request,$model,$fileName,$folder){
        try {
            $data = $request->all();
            $data[$fileName] =$this->hasFileCreate($request,$fileName,$folder);
             $model::create($data);
             return ResponseMessage::succesfulResponse(); 
        } catch (\Exception $exception) {
            return  $exception->getMessage();
        }
    }

}

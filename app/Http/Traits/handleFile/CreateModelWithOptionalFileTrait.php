<?php

namespace App\Http\Traits\handleFile;

use App\services\ResponseMessage;

trait CreateModelWithOptionalFileTrait
{
    use HasOptionalFileCreateTrait;
    protected function createModelWithOptionalFile($request,$model,$fileName,$folder){
        try {
            $data = $request->all();
            $data[$fileName] =$this->hasOptionalFileCreate($request,$fileName,$folder);
             $model::create($data);
             return ResponseMessage::succesfulResponse(); 
        } catch (\Exception $exception) {
            return  $exception->getMessage();
        }
    }

}

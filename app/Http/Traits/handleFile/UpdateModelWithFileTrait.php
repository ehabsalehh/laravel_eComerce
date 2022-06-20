<?php

namespace App\Http\Traits\handleFile;
use App\services\ResponseMessage;

trait UpdateModelWithFileTrait
{
    // use HasFileUpdateTrait;
    protected function updateModelWithlFile($request,$model,$modelAttribute,$fileName,$folder){
        try {
            $data = $request->all();
            $data[$fileName] =$this->hasFileUpdate($request,$modelAttribute,$fileName,$folder);
            $model->update($data);
            return ResponseMessage::succesfulResponse();
        }catch (\Exception $exception) {
            return  $exception->getMessage();
        }
    }

}

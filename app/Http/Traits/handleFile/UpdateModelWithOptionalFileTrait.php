<?php

namespace App\Http\Traits\handleFile;
use App\services\ResponseMessage;

trait UpdateModelWithOptionalFileTrait
{
    use HasOptionalFileUpdateTrait;
    protected function updateModelWithOptionalFile($request,$model,$modelAttribute,$fileName,$folder){
        try {
            $data = $request->all();
            $data[$fileName] =$this->hasOptionalFileUpdate($request,$modelAttribute,$fileName,$folder);
            $model->update($data);
            return ResponseMessage::succesfulResponse();
        }catch (\Exception $exception) {
            return  $exception->getMessage();
        }
    }

}

<?php

namespace App\Services\Auth;

use App\Http\Traits\handleFile\UploadEmployeeFileTrait;
use App\Models\Employee;
use App\services\ResponseMessage;

class RegisterEmployee
{
    use UploadEmployeeFileTrait;
    private $data;
    public function register($request)
    {
        try {
            $this->data = $request->validated();
            $this->data['photo'] =$this->uploadEmployeeFile($request);
            $this->data['password'] = bcrypt($request['password']);
            Employee::create($this->data);
            return  ResponseMessage::succesfulResponse();    
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
         
    }

}

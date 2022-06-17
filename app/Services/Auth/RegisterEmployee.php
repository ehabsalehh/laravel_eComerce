<?php

namespace App\Services\Auth;

use App\Models\Employee;
use App\services\ResponseMessage;
use App\Services\HandleFiles\UploadEmployeeFile;

class RegisterEmployee
{
    private $uploadEmployeeFile;
    private $data;
    public function register($request,UploadEmployeeFile $uploadEmployeeFile)
    {
        try {
            $this->data = $request->all();
            $this->uploadEmployeeFile = $uploadEmployeeFile;
            $this->data['photo'] =$this->uploadEmployeeFile->getFileName();
            $this->data['password'] = bcrypt($request['password']);
            Employee::create($this->data);
            return  ResponseMessage::succesfulResponse();    
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
         
    }

}

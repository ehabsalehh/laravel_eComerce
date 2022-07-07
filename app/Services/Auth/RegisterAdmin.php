<?php

namespace App\Services\Auth;

use App\Models\Employee;
use App\services\ResponseMessage;
use App\Http\Traits\handleFile\UploadAdminFileTrait;
use App\Models\Admin;

class RegisterAdmin
{
    use UploadAdminFileTrait;
    private $data;
    public function register($request)
    {
        try {
            $this->data = $request->validated();
            // return $this->uploadAdminFile($request);
            $this->data['photo'] =$this->uploadAdminFile($request);
            $this->data['password'] = bcrypt($request['password']);
            Admin::create($this->data);
            return  ResponseMessage::succesfulResponse();    
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
         
    }

}

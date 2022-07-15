<?php

namespace App\Services\Employee\Auth;

use App\Models\Employee;
use App\services\ResponseMessage;
use App\Services\Employee\Traits\uploadableFile;

class Register
{
    use uploadableFile;
    private $data;
    public function register($request)
    {
        try {
            $this->data = $request->validated();
            $fileName = $request->file('photo')->getClientOriginalName(); 
            $request->file('photo')->storeAs('attachments/Employees',$fileName,'upload_attachments');
            $this->data['photo'] =$fileName;
            $this->data['password'] = bcrypt($request['password']);
            Employee::create($this->data);
            return  ResponseMessage::successResponse();    
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
         
    }

}

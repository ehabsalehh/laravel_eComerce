<?php

namespace App\Services\Employee\Auth;

use App\Models\Employee;
use App\services\ResponseMessage;

class Register
{
    public function register($request)
    {
        try {
            $data = $request->validated();
            $data['password'] = bcrypt($request['password']);
            $employee = Employee::create($data);
            $employee->addMediaFromRequest('avatar')
                    ->toMediaCollection('employee-avatar');
            return  ResponseMessage::successResponse();    
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
         
    }

}

<?php

namespace App\Services\Auth;

use App\Models\Employee;
use App\services\ResponseMessage;
use Illuminate\Support\Facades\Hash;

class CahngeEmoloyeePassword
{
    public function changePassword($request){
        Employee::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        return ResponseMessage::succesfulResponse();
    }

}

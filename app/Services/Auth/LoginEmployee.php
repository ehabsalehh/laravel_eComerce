<?php

namespace App\Services\Auth;

use App\Models\Employee;
use App\services\ResponseMessage;
use Illuminate\Support\Facades\Hash;

class LoginEmployee
{
    public  function Login($request){
        $admin = Employee::where('email', $request->email)->first();
            if (! $admin || ! Hash::check($request->password, $admin->password)) {
                return ResponseMessage::failedResponse();
            }
        return $admin->createToken("myapp")->plainTextToken;  
    }

}

<?php

namespace App\Services\Auth;

use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class LoginEmployee
{
    public  function Login($request){
        $employee = Employee::where('email', $request->email)->first();
            if (! $employee || ! Hash::check($request->password, $employee->password)) {
                return ;
            }
        return $employee->createToken("myapp")->plainTextToken;  
    }

}

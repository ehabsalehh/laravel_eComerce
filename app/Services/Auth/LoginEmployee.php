<?php

namespace App\Services\Auth;

use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class LoginEmployee
{
    public  function Login($request){
        $admin = Employee::where('email', $request->email)->first();
            if (! $admin || ! Hash::check($request->password, $admin->password)) {
                return ;
            }
        return $admin->createToken("myapp")->plainTextToken;  
    }

}

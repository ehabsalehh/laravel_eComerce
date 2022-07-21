<?php

namespace App\Services\Employee\Auth;

use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class Login
{
    public  function Login($request){
        $validated= $request->validated();
        if (Auth::guard('employee')->attempt($validated, $request->get('remember'))) {
            $employee=  Auth::guard('employee')->user();
            return $employee->createToken("myapp")->plainTextToken;
        }  
    }
   

}

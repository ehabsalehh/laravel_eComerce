<?php

namespace App\Services\Employee\Auth;

use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class Login
{
    public  function Login($request){
        $validated= $request->validate($this->rules());
        if (Auth::guard('employee')->attempt($validated, $request->get('remember'))) {
            $employee=  Auth::guard('employee')->user();
            return $employee->createToken("myapp")->plainTextToken;
        }  
    }
    private function rules():array
    {
        return [
            'email' => ['required','email'],
            'password' => ['required',Password::min(8)->mixedCase()]
        ];
    }

}

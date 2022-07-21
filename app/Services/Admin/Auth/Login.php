<?php

namespace App\Services\Admin\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class Login
{
    public  function Login($request){
        $validated= $request->validated();
        if (Auth::guard('admin')->attempt($validated)) {
            $admin=  Auth::guard('admin')->user();
            return $admin->createToken("myapp")->plainTextToken;
        }  
    }
}

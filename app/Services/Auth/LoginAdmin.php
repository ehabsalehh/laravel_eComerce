<?php

namespace App\Services\Auth;

use App\Models\Admin;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginAdmin
{
    public  function Login($request){
        $admin = Admin::where('email', $request->email)->first();
            if (! $admin || ! Hash::check($request->password, $admin->password)) {
                return ;
            }
        return $admin->createToken("myapp")->plainTextToken;  
    }

}

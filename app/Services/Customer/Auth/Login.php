<?php

namespace App\Services\Customer\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\LoginCustomerRequest;

class Login
{
    public function login(  $request){
        
        $validated= $request->validated();
        if (Auth::guard('customer')->attempt($validated, $request->get('remember'))) {
            $customer = Auth::guard('customer')->user();
            return $customer->createToken("myapp")->plainTextToken;
        }
        // if (Auth::attempt($validated)) {
        //     $user = Auth::user(); 
        //     return $user->createToken('MyApp')->plainTextToken;  
        // }
    }
        public function loginWep(  $request){
            $validated= $request->validated();
            if (Auth::attempt($validated)) { 
                return redirect()->intended('viewCheckOut'); 
            }
            return redirect()->intended('login'); 
        
    }
}

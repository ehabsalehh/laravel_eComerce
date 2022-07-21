<?php

namespace App\Services\Customer\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\LoginCustomerRequest;

class Login
{
    public function loginApi( Request $request){
        $validated= $request->validated();
        if (Auth::attempt($validated)) {
            $user = Auth::user(); 
            return $user->createToken('MyApp')->plainTextToken;  
        }
    }
        public function login( Request $request){
            $validated= $request->validated();
            if (Auth::attempt($validated)) { 
                return redirect()->intended('viewCheckOut'); 
            } 
        
    }
}

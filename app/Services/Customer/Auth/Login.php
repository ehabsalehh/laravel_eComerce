<?php

namespace App\Services\Customer\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\LoginCustomerRequest;

class Login
{
    public function login( Request $request){
        $validated= $request->validate($this->rules());
        if (Auth::attempt($validated)) {
            $user = Auth::user(); 
            return $user->createToken('MyApp')->plainTextToken;  
        } 
        
    }
    public function rules():array
    {
        return [
            'email' => ['required','email'],
            'password' => ['required',Password::min(8)->mixedCase()]
        ];
    } 

}

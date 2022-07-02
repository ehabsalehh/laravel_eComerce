<?php

namespace App\Http\Controllers\Auth;

use App\Services\Auth\LoginCustomer;
use Illuminate\Support\Facades\Auth;
use App\Services\Auth\RegisterCustomer;
use App\Http\Requests\LoginCustomerRequest;
use App\Http\Requests\RegisterCustomerRequest;

class AuthCustomerController
{
    private $register;
    private $login;
    public function __construct(RegisterCustomer $register,LoginCustomer $login)
    {
        $this->register = $register;
        $this->login = $login;
    }
    public function register(RegisterCustomerRequest $request){
        return $this->register->store($request);

    }
    public function Login(LoginCustomerRequest $request){
        if (Auth::attempt($request->validated())) {
            $request->session()->regenerate();
            return to_route('createTransaction');

        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
        // return $this->login->Login($request);
    }
    public function logout() {
        auth()->user()->tokens()->delete();
       return [
            'message' => 'Logged out'
        ];
    }

}

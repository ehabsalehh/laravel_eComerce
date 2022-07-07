<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\LoginEmployee;
use App\Services\Auth\RegisterEmployee;
use App\Http\Requests\LoginEmployeeRequest;
use App\Http\Requests\ReqisterEmployeeRequest;

class AuthEmployeeController extends Controller
{
    private $registerEmployee;
    private $loginEmployee;
    public function register(ReqisterEmployeeRequest $request,RegisterEmployee $registerEmployee){
        $this->registerEmployee = $registerEmployee;
        return $this->registerEmployee->register($request);
    }
    public function login(LoginEmployeeRequest $request,LoginEmployee $loginEmployee){
        $this->loginEmployee = $loginEmployee;
        return $this->loginEmployee->Login($request);
    }
    public function logout() {
        auth()->user()->tokens()->delete();
       return [
            'message' => 'Logged out'
        ];
    }
}

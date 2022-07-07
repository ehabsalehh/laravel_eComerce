<?php

namespace App\Http\Controllers\Auth;

use App\Services\Auth\LoginAdmin;
use App\Http\Controllers\Controller;
use App\Services\Auth\RegisterAdmin;
use App\Http\Requests\LoginAdminRequest;
use App\Http\Requests\ReqisterAdminRequest;

class AuthAdminController extends Controller
{
    private $registerAdmin;
    private $loginAdmin;
    public function register(ReqisterAdminRequest $request,RegisterAdmin $registerAdmin){
        $this->registerAdmin = $registerAdmin;
        return $this->registerAdmin->register($request);
    }
    public function login(LoginAdminRequest $request,LoginAdmin $loginAdmin){
        $this->loginAdmin = $loginAdmin;
        return $this->loginAdmin->Login($request);
    }
    public function logout() {
        auth()->user()->tokens()->delete();
       return [
            'message' => 'Logged out'
        ];
    }
}

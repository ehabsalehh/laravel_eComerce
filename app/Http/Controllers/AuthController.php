<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Services\Auth\LoginUserTrait;
use App\Http\Requests\LoginUserRequest;
use App\Services\Auth\RegisterUserTrait;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    use RegisterUserTrait,
    LoginUserTrait
    ;
    public function register(RegisterUserRequest $request)
    {
        return new UserResource($this->registerUser($request));
    }
    public function login(LoginUserRequest $request){
        return $this->LoginUser($request);
    }
    public function logout() {
        auth()->user()->tokens()->delete();
       return [
            'message' => 'Logged out'
        ];
    }
}

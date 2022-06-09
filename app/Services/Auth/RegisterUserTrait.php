<?php

namespace App\Services\Auth;

use App\Models\User;

trait RegisterUserTrait
{
    protected function registerUser($request){
        return User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        
        ]);
    } 

}

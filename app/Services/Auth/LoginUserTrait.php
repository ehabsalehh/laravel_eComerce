<?php

namespace App\Services\Auth;

use App\Models\User;
use App\services\ResponseMessage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

trait LoginUserTrait
{
protected function LoginUser($request){
    $user = User::where('email', $request->email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return ResponseMessage::failedResponse();
        }
    return $user->createToken("myapp")->plainTextToken;  
}
}

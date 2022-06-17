<?php

namespace App\Services\Auth;

use App\Models\Customer;
use App\services\ResponseMessage;
use Illuminate\Support\Facades\Hash;

class LoginCustomer
{
    public function Login($request){
        $Customer = Customer::where('email', $request->email)->first();
            if (! $Customer || ! Hash::check($request->password, $Customer->password)) {
                return ResponseMessage::failedResponse();
            }
        return $Customer->createToken("myapp")->plainTextToken;  
    }

}

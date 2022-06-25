<?php

namespace App\Services\Auth;

use App\Models\Customer;
use App\services\ResponseMessage;
use Illuminate\Support\Facades\Hash;

class ChangeCustomerPassword
{
    public function changePassword($request){
        Customer::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        return ResponseMessage::succesfulResponse();
    }

}

<?php
namespace App\Services\Customer\Home;
use App\Models\Customer;
use App\Rules\MatchOldPassword;
use App\services\ResponseMessage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ChangeCustomerPassword
{
    public function changePassword($request){
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required',Password::min(8)->mixedCase()],
            'password_confirmation' => ['same:new_password'],
        ]);
        Customer::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        return ResponseMessage::successResponse();
    }

}

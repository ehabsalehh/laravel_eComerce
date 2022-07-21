<?php

namespace App\Services\Admin\Home;

use App\Models\Admin;
use App\Rules\MatchOldPassword;
use App\services\ResponseMessage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ChangeAdminPassword
{
    public function changePassword($request){
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required',Password::min(8)->mixedCase()],
            'password_confirmation' => ['same:new_password'],
        ]);
        Admin::find(auth()->id())->update(['password'=> Hash::make($request->new_password)]);
        return ResponseMessage::successResponse();
    }

}

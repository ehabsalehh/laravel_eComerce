<?php
namespace App\Services\Employee\Home;
use App\Models\Employee;
use App\services\ResponseMessage;
use Illuminate\Support\Facades\Hash;
class ChangeEmployeePassword
{
    public function changePassword($request){
        Employee::find(auth()->id())->update(['password'=> Hash::make($request->new_password)]);
        return ResponseMessage::successResponse();
    }
}

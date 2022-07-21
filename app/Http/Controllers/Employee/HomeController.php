<?php

namespace App\Http\Controllers\Employee;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\services\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Services\Employee\Home\ChangeEmployeePassword;

class HomeController extends Controller
{
    public function ChangeEmployeePassword(Request $Request,ChangeEmployeePassword $changePassword){
        $this->changePassword = $changePassword;
       return  $this->changePassword->changePassword($Request);
    }
    public function profile(){
       return Auth()->user();
    }
    public function profileUpdate(Request $request, Employee $employee){
        $request->validate([
            'avatar' => ['image','required']
        ]);
        $employee->addMediaFromRequest('avatar')
                ->toMediaCollection('employee-avatar');
        return ResponseMessage::successResponse();
    }
}

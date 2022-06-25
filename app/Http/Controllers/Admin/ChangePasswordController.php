<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Services\Auth\CahngeEmoloyeePassword;

class ChangePasswordController extends Controller
{
    private $changePassword;
    public function ChangeEmployeePassword(ChangePasswordRequest $Request,CahngeEmoloyeePassword $changePassword){
        $this->changePassword = $changePassword;
       return  $this->changePassword->changePassword($Request);
    }
}

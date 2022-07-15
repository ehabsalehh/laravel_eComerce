<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterCustomerRequest;
use Illuminate\Support\Facades\Hash;
use App\Services\Admin\Auth\Register;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ReqisterAdminRequest;
use App\Http\Requests\ReqisterEmployeeRequest;
use App\Services\Customer\Auth\Register as CustomerAuthRegister;
use App\Services\Employee\Auth\Register as AuthRegister;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    private $createAdmin;
    private $createEmployee;
    private $createCustomer;
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:employee')->except('logout');
        $this->middleware('guest:customer')->except('logout');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function createAdmin(ReqisterAdminRequest $request, Register $register)
    {
        $this->createAdmin =$register;
        return $this->createAdmin->register($request);
    }
    public function createEmployee(ReqisterEmployeeRequest $request, AuthRegister $register)
    {
        $this->createEmployee =$register;
        return $this->createEmployee->register($request);
    }
    public function createCustomer(RegisterCustomerRequest $request, CustomerAuthRegister $register)
    {
        $this->createCustomer =$register;
        return $this->createCustomer->register($request);
    }
}

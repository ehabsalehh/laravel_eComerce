<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\Customer\Auth\Login;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Services\Admin\Auth\Login as AdminAuthLogin;
use App\Services\Employee\Auth\Login as EmployeeAuthLogin;

class LoginController extends Controller
{
    private $adminLogin;
    private $customerLogin;
    private $employeeLogin;

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
    public function adminLogin(LoginRequest $request,AdminAuthLogin $adminLogin){
        $this->adminLogin = $adminLogin;
        return $this->adminLogin->Login($request);
    }
    public function customerLogin(LoginRequest $request, Login $customerLogin){
        $this->customerLogin = $customerLogin;
       return  $this->customerLogin->login($request);
    }
    public function employeeLogin(LoginRequest $request ,EmployeeAuthLogin $login){
        $this->employeeLogin = $login;
        return $this->employeeLogin->Login($request);
    }
   

}

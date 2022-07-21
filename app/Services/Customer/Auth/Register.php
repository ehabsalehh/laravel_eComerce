<?php

namespace App\Services\Customer\Auth;

use App\Models\Customer;
use App\services\ResponseMessage;

class Register
{
    private $data;
    public function register($request){
        try {
            $this->data = $request->all();
            $this->data['password'] = bcrypt($request['password']);
             Customer::create($this->data);
             return ResponseMessage::successResponse();    
        } catch (\Throwable $th) {
            throw $th;
        }
        
        
    }

}

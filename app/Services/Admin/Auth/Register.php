<?php
namespace App\Services\Admin\Auth;
use App\Models\Admin;
use App\services\ResponseMessage;
class Register
{
    public function register( $request)
    {
        try {
            $data = $request->validated();
            $data['password'] = bcrypt($request['password']);
            $admin = Admin::create($data);
            $admin->addMediaFromRequest('avatar')
                    ->toMediaCollection('admin-avatar');
            return  ResponseMessage::successResponse();    
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
         
    }

}

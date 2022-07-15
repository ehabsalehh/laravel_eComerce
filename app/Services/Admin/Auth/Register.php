<?php
namespace App\Services\Admin\Auth;
use App\Models\Admin\Admin;
use App\services\ResponseMessage;
class Register
{
    private $data;
    private $fileName;

    public function register( $request)
    {
        try {
            $this->data = $request->validated();
            $this->fileName = $request->file('photo')->getClientOriginalName(); 
            $request->file('photo')->storeAs('attachments/Admins',$this->fileName,'upload_attachments');
            $this->data['photo'] =$this->fileName;
            $this->data['password'] = bcrypt($request['password']);
            Admin::create($this->data);
            return  ResponseMessage::successResponse();    
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
         
    }

}

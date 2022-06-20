<?php

namespace App\Http\Traits\Cart;

use App\Models\Cart;
use App\services\ResponseMessage;
use Illuminate\Support\Facades\Auth;

trait CreateNewCartTrait
{
    protected function  createNewCart($request){
        $data= $request->validated();
        $data['customer_id'] = Auth::id();
        Cart::create($data);
        return ResponseMessage::succesfulResponse();
    }        
}

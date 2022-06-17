<?php

namespace App\Http\Traits\Cart;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

trait CreateNewCartTrait
{
    protected function  createNewCart($request){
        $data= $request->all();
        $data['customer_id'] = Auth::id();
        Cart::create($data);
    }        
}

<?php

namespace App\Http\Traits\Cart;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

trait GetAllCartWithTrait
{
    protected function getAllCartWith(){
        return Cart::with('product','user')->get();
    }
}

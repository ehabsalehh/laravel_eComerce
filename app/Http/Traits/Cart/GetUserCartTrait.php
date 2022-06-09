<?php

namespace App\Http\Traits\Cart;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

trait GetUserCartTrait
{
    protected function getUserCart(){
        return Cart::userId(Auth::id())->get();
    }
}

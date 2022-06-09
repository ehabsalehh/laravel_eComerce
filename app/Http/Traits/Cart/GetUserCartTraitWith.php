<?php

namespace App\Http\Traits\Cart;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

trait GetUserCartTraitWith
{
    protected function getUserCartWith(){
        return Cart::userId(Auth::id())->with('product','user')->get();
    }
}

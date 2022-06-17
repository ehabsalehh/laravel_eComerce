<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ViewMyOrderCollection;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $orders = Order::customerId(Auth::id())->with('orderItems')->get();
        return new ViewMyOrderCollection($orders);
    }
}

<?php

namespace App\Http\Controllers\Customer;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ViewMyOrderCollection;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index()
    {
        $orders = Order::customerId(Auth::id())->with('orderItems')->get();
        return new ViewMyOrderCollection($orders);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;

class DashboardController extends Controller
{
    public function customers()
    {
        return  new CustomerResource(Customer::all());
    }
    public function view_Customer(Customer $Customer)
    {
        return  new CustomerResource($Customer);
    }
    
}

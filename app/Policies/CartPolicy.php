<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer\Checkout\Cart;
use Illuminate\Auth\Access\HandlesAuthorization;

class CartPolicy
{
    use HandlesAuthorization;

    public function delete(Customer $customer,Cart $cart){        
        return $customer->id === $cart->customer_id;
    }
}

<?php

namespace App\Policies;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CartPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function delete(Customer $customer,Cart $cart){
        
        return $customer->id === $cart->customer_id;

    }
}

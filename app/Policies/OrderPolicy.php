<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
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
    public function delete(Customer $customer,Order $order){
        
        return $customer->id === $order->customer_id;

    }
}

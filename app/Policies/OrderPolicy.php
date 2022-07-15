<?php

namespace App\Policies;

use App\Models\Customer\Customer;
use App\Models\Customer\Checkout\Order;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;
    public function delete(Customer $customer,Order $order){ 
        return $customer->id === $order->customer_id;
    }
}

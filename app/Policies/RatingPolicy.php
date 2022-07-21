<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\Customer\Review\Rating;
use Illuminate\Auth\Access\HandlesAuthorization;

class RatingPolicy
{
    use HandlesAuthorization;
    public function delete(Customer $customer, Rating $Rating)
    {
        return $customer->id === $Rating->customer_id;
    }
    
}

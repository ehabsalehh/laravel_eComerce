<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Customer;
use App\Models\Review;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewPolicy
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
    public function update(Customer $customer,Review $review){
        
        return $customer->id === $review->customer_id;

    }
    public function delete(Customer $customer,Review $review){
        
        return $customer->id === $review->customer_id;

    }
}

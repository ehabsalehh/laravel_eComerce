<?php

namespace App\Policies;

use App\Models\Customer\Customer;
use App\Models\Customer\Review\Review;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewPolicy
{
    use HandlesAuthorization;

    public function update(Customer $customer, Review $review)
    {
        return $customer->id === $review->customer_id;

    }

    public function delete(Customer $customer, Review $Review)
    {
        return $customer->id === $Review->customer_id;

    }
   

   
}

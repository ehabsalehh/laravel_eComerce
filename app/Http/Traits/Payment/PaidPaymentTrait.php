<?php

namespace App\Http\Traits\Payment;
trait PaidPaymentTrait
{
    public function paidPayment()
    {
        $payment = [];
        $payment['method']='paypal';
        $payment['status']='paid';
        return $payment;
    }

}

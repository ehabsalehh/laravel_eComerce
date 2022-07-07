<?php

namespace App\Http\Traits\Payment;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

trait UnPaidPaymentTrait
{
    public function unPaidPayment()
    {
        $payment = [];
        $payment['method']='cod';
        $payment['status']='Unpaid';
        return $payment;
    }

}

<?php

namespace App\Http\Traits\Payment;

use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

trait PaidPaymentTrait
{
    public function paidPayment($order)
    {
        $payment = [];
        $payment['method']='paypal';
        $payment['status']='paid';
        $payment['order_id']=$order->id;
        $payment['employee_id']=$order->employee_id;
        $payment['amount']=$order->total;
        $payment['customer_id']=Auth::id();
        Payment::create($payment);
    }

}

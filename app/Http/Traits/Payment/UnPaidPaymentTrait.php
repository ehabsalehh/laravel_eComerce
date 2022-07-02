<?php

namespace App\Http\Traits\Payment;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

trait UnPaidPaymentTrait
{
    public function unPaidPayment($order)
    {
        $payment = [];
        $payment['method']='cod';
        $payment['status']='Unpaid';
        $payment['order_id']=$order->id;
        $payment['employee_id']=$order->employee_id;
        $payment['amount']=$order->total;
        $payment['customer_id']=Auth::id();
        Payment::create($payment);
    }

}

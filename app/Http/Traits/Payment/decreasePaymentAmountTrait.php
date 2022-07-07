<?php

namespace App\Http\Traits\Payment;

use App\Models\Payment;

trait decreasePaymentAmountTrait
{
    public function decreaseAmount($order){
        $payment = Payment::where('order_id',$order->id)->first();
        $payment->amount = $order->total;
        $payment->save();
    }
}

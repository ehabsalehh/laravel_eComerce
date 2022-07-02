<?php

namespace App\Observers;

use App\Models\Order;
use App\Http\Traits\Cart\SubTotalPriceTrait;
use App\Http\Traits\Payment\PaidPaymentTrait;
use App\Http\Traits\Cart\GetCustomerCartTrait;
use App\Http\Traits\Payment\UnPaidPaymentTrait;

use App\Http\Traits\Cart\DestroyCustomerCartTrait;
use App\Http\Traits\OrderItem\CreateOrderItemTrait;
use App\Http\Traits\Product\DecreseInventoryQuantityTrait;

class OrderObserver
{
    use 
    DestroyCustomerCartTrait,
        DecreseInventoryQuantityTrait,
        GetCustomerCartTrait,
        CreateOrderItemTrait,
        PaidPaymentTrait,
        UnPaidPaymentTrait
   
    ;
   
   
    /**
     * Handle the Order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function created(Order $order)
    {

        $cartItems = $this->getCustomerCart();
        $cartItems->map(function($item)use($order){
            $this->CreateOrderItem($order->id,$item);
        });     
        $this->destroyCustomerCart();

        if(request()->payment_mode =='placeOrder'){
             $this->unPaidPayment($order);
        }
        elseif(request()->payment_mode = 'paid with paypal'){
            $this->paidPayment($order);
        }  
       
       

    }

    /**
     * Handle the Order "updated" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        
    }

    /**
     * Handle the Order "deleting" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function deleting(Order $order)
    {
        $order->orderItems()->delete();
    }

    /**
     * Handle the Order "restored" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}

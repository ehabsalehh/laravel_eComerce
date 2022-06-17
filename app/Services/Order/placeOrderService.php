<?php
namespace App\services\Order;


use App\services\ResponseMessage;
use App\Http\Traits\Cart\GetCustomerCartTrait;
use App\Http\Traits\Order\CreateOrderTrait;
use App\Http\Traits\Cart\DestroyCustomerCartTrait;
use App\Http\Traits\OrderItem\CreateOrderItemTrait;
use App\Http\Traits\Product\DecreseProductQuantityTrait;

class placeOrderService{
    use CreateOrderTrait,
        CreateOrderItemTrait,
        DecreseProductQuantityTrait,
        DestroyCustomerCartTrait,
        GetCustomerCartTrait

        ;
    public function placeOrder($request){
       try {
            $order = $this->CreateOrder($request);
            $cartItems = $this->getCustomerCart();
            foreach($cartItems as $item){
                $this->CreateOrderItem($order->id,$item);
                $this->decreseProductQuantity($item); 
            }
            $this->destroyCustomerCart();
            return ResponseMessage::succesfulResponse();
        } catch (\Throwable $th) { 
            return $th->getMessage();
        }       
    }
    
}
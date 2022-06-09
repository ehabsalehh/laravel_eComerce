<?php
namespace App\services\Order;


use App\services\ResponseMessage;
use App\Http\Traits\Cart\GetUserCartTrait;
use App\Http\Traits\Order\CreateOrderTrait;
use App\Http\Traits\Cart\DestroyUserCartTrait;
use App\Http\Traits\OrderItem\CreateOrderItemTrait;
use App\Http\Traits\Product\DecreseProductQuantityTrait;

class placeOrderService{
    use CreateOrderTrait,
        CreateOrderItemTrait,
        DecreseProductQuantityTrait,
        DestroyUserCartTrait,
        GetUserCartTrait

        ;
    public function placeOrder($request){
       try {
            $order = $this->CreateOrder($request);
            $cartItems = $this->getUserCart();
            foreach($cartItems as $item){
                $this->CreateOrderItem($order->id,$item);
                $this->decreseProductQuantity($item); 
            }
            $this->destroyUserCart();
            return ResponseMessage::succesfulResponse();
        } catch (\Throwable $th) { 
            return $th->getMessage();
        }       
    }
    
}
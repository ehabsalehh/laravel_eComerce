<?php
namespace App\services\Order;


use App\Models\Order;
use App\services\ResponseMessage;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\Order\CreateOrderTrait;
use App\Http\Traits\Cart\GetCustomerCartTrait;
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
            DB::beginTransaction();
            $order = $this->CreateOrder($request);
            $cartItems = $this->getCustomerCart();
            $cartItems->map(function($item)use($order){
                $this->CreateOrderItem($order->id,$item);
                // if order status not new 
                $this->decreseInventoryQuantity($item);
            });
            $this->destroyCustomerCart();
            DB::commit();
            return ResponseMessage::succesfulResponse();
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }  
    }
    
}
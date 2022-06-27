<?php

namespace App\Services\Order;

use App\Models\Order;
use Illuminate\Support\Carbon;
use App\services\ResponseMessage;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isNull;
use App\Http\Traits\Order\DecreaseOrderPriceTrait;
use App\Http\Traits\Order\OldOlderthanNumberDaysTrait;

use App\Http\Traits\OrderItem\GetProductOrderItemTrait;
use App\Http\Traits\Order\DecreaseOrderPriceHasDiscountTrait;
use App\Http\Traits\OrderItem\DecreaseOrderItemQuantityTrait;

class ReturnItemService
{
    use GetProductOrderItemTrait,
        DecreaseOrderItemQuantityTrait,
        DecreaseOrderPriceTrait,
        DecreaseOrderPriceHasDiscountTrait,
        OldOlderthanNumberDaysTrait
    ;
    public function returnItem($request){
        try {
            DB::beginTransaction();
            $getProductOrderItem =$this->getProductOrderItem($request);
            $orderItems= $getProductOrderItem->orderItems->first();
            if(empty($orderItems)){return ;}
            if($this->oldOlderthanNumberDays($orderItems,15)){return;}
            $inventory = $getProductOrderItem->inventory->first();
            $this->DecreaseOrderItemQuantity($orderItems,$inventory);
             $order = Order::where('id',$orderItems->order_id)->with('shipping')->first();
            $this->orderHasNotDiscount($getProductOrderItem,$order);            
            $this->orderHasDiscount($getProductOrderItem,$order);
            $order->when($order->total == $order->shipping->price,function ()use($order){$order->delete();}); 
            DB::commit();   
        return ResponseMessage::succesfulResponse();    
        } catch (\Throwable $th) {
            DB::rollback();
            return $th->getMessage();
        }
        
    }


}

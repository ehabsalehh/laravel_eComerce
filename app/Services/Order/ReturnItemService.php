<?php

namespace App\Services\Order;

use App\Models\Order;
use Illuminate\Support\Carbon;
use App\services\ResponseMessage;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isNull;
use App\Http\Traits\Order\DecreaseOrderPriceTrait;
use App\Http\Traits\OrderItem\GetProductOrderItemTrait;

use App\Http\Traits\Order\DecreaseOrderPriceHasDiscountTrait;
use App\Http\Traits\OrderItem\DecreaseOrderItemQuantityTrait;

class ReturnItemService
{
    use GetProductOrderItemTrait,
        DecreaseOrderItemQuantityTrait,
        DecreaseOrderPriceTrait,
        DecreaseOrderPriceHasDiscountTrait
    ;
    public function returnItem($request){
        try {
            DB::beginTransaction();
            $getProductOrderItem =$this->getProductOrderItem($request);
            $orderItems= $getProductOrderItem->orderItems->first();
            if(empty($orderItems)){return ResponseMessage::failedResponse();}
            $created = new Carbon($orderItems->created_at);
            $now = Carbon::now();
            if($created->diff($now)->days >15){return ResponseMessage::failedResponse();}
            // $discount =is_null($getProductOrderItem->discount)?null:$getProductOrderItem->discount->first();
            $inventory = $getProductOrderItem->inventory->first();
            $this->DecreaseOrderItemQuantity($orderItems,$inventory);
            $order = Order::findOrFail($orderItems->order_id);
            $this->orderHasNotDiscount($getProductOrderItem,$order);            
            $this->orderHasDiscount($getProductOrderItem,$order);
            $order->when($order->total == 0,function ()use($order){$order->delete();}); 
            DB::commit();   
        return ResponseMessage::succesfulResponse();    
        } catch (\Throwable $th) {
            DB::rollback();
            return $th->getMessage();
        }
        
    }


}

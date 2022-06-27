<?php

namespace App\Http\Traits\Order;

use App\Models\Order;
use Illuminate\Support\Carbon;
use App\services\ResponseMessage;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isNull;
use phpDocumentor\Reflection\Types\Null_;
use App\Http\Traits\OrderItem\GetProductOrderItemTrait;

use App\Http\Traits\Product\DecreseProductQuantityTrait;
use App\Http\Traits\OrderItem\DecreaseOrderItemQuantityTrait;

trait ReturnItemTrait
{
    use GetProductOrderItemTrait,
        DecreaseOrderItemQuantityTrait
    ;
    protected function decreaseOrderTotalPrice($request){
        try {
            DB::beginTransaction();
            $getProductOrderItem =$this->getProductOrderItem($request);
            $orderItems= $getProductOrderItem->orderItems->first();
            $discount = isNull($getProductOrderItem->discount)?null:$getProductOrderItem->discount->first();
            $inventory = $getProductOrderItem->inventory->first();
            // order Should be sold before 15 days to return
            $created = new Carbon($orderItems->created_at);
            $now = Carbon::now();
            if($created->diff($now)->days >15){return ;}
            $this->DecreaseOrderItemQuantity($orderItems,$inventory);
            // done
            $order = Order::findOrFail($orderItems->order_id);
            
            if(is_null($discount)){
                $order->sub_total -=  $getProductOrderItem->price;
                $order->total -=  $getProductOrderItem->price;
                $order->save();
            }
            // product has discount
            if(!empty($discount)){
                $Price = $getProductOrderItem->price;
                $percentValue = 1/$discount->percent *$Price;
                $discountPrice = $percentValue +$Price;
                // 
                $order->sub_total -=  $Price;
                $order->total_discount -= $percentValue;
                $order->total -=  $discountPrice;
                $order->save();
            }
            $order->when($order->total == 0,function ()use($order){$order->delete();}); 
            DB::commit();   
        return ResponseMessage::succesfulResponse();    
        } catch (\Throwable $th) {
            DB::rollback();
            return $th->getMessage();
        }
        
    }

}

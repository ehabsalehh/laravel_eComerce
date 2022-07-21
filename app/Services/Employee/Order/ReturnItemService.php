<?php
namespace App\Services\Order;
use Illuminate\Http\Request;
use App\services\ResponseMessage;
use Illuminate\Support\Facades\DB;
use App\Models\Customer\Checkout\Order;
use App\Models\Employee\Product\Product;
use App\Models\Customer\Checkout\Payment;
class ReturnItemService
{
    public function returnItem( Request $request){
        try {
            DB::beginTransaction();
            $validated= $request->validate([
                'product_id'=>["required","exists:products,id"],
                'order_id'=>["required","exists:orders,id"],
            ]);
            $getProductOrderItem =$this->getProductOrderItem($validated);
            $orderItems= $getProductOrderItem->orderItems->first();
            if(empty($orderItems)){return ;}
            if($orderItems->created_at < now()->subDays(15)){return;}
            $inventory = $getProductOrderItem->inventory->first();
            $this->DecreaseOrderItemQuantity($orderItems,$inventory);
            $order = Order::where('id',$orderItems->order_id)->first();
            $this->orderHasDiscount($getProductOrderItem,$order);
            $this->orderHasNotDiscount($getProductOrderItem,$order);            
            Payment::where('order_id',$order->id)->update(['amount'=>$order->total]);
            // $order->when($order->total == $order->shipping->price,function ()use($order){$order->delete();}); 
            DB::commit();   
        return ResponseMessage::successResponse();    
        } catch (\Throwable $th) {
            DB::rollback();
            return $th->getMessage();
        }
    }
    private function getProductOrderItem($request){
        return Product::where('id',$request->product_id)
            ->with(['orderItems'=>function($query) use($request){
                    $query->where('order_id',$request->order_id)
                    ->where('customer_id',auth()->id())
                    ->where('product_id',$request->product_id);
        },'discount','inventories'])
        ->select('products.id','products.price','products.tax','discount_id')->first();
    }
    private function DecreaseOrderItemQuantity($orderItems,$inventory){
        if($orderItems->quantity == 1){
            $orderItems->delete();
            $inventory->quantity +=1;
            $inventory->save();
        }
        $orderItems->quantity -=1;
        $orderItems->save();
        $inventory->quantity +=1;
        $inventory->save();        
    }
    protected function orderHasDiscount($getProductOrderItem,$order){
        if(isset($getProductOrderItem->discount)){
            $discount= $getProductOrderItem->discount->first();
            $priceWithTax=  $this->getPrice($getProductOrderItem);
            $discountValue = $discount->percent/100 * $priceWithTax;
            $PriceWithDiscount = $priceWithTax- $discountValue ;
            $order->total_discount -= $discountValue;
            $order->sub_total -=  $priceWithTax;
            $order->total -= $PriceWithDiscount;
            $order->save();           
        }
    }
    protected function orderHasNotDiscount($getProductOrderItem,$order){
        if(is_null($getProductOrderItem->discount)){
            $priceWithTax=  $this->getPrice($getProductOrderItem);
            $order->sub_total -=  $priceWithTax;//with tax
            $order->total -= $priceWithTax;
            $order->save();   
        }
    }
    private function getPrice($getProductOrderItem){
        $taxValue= $getProductOrderItem->tax/100*$getProductOrderItem->price;
        return $getProductOrderItem->price +$taxValue;

    }

}
<?php
namespace App\Http\Controllers\Employee\Order;
use Illuminate\Http\Request;
use App\services\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Customer\Checkout\Order;
use App\Http\Resources\OrderItemResource;
use App\Services\Order\ReturnItemService;
use App\Models\Customer\Checkout\OrderItem;
use App\Services\Employee\Order\UpdateStatus;
class OrderController extends Controller
{    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return  OrderResource::collection(Order::getStatusNewOrder()->with('orderItems.product')->paginate(2));
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( Order $order)
    {
        return new OrderResource($order->with('orderItems.product')->first());
    }    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Order $order,UpdateStatus $update)
    {
        $updateStatus = $update;
        return $updateStatus->updateStatus($request,$order);
    }
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->orderItems()->delete();
         $order->delete();
         return ResponseMessage::successResponse();
    }
    public function getOrderItems($orderId){
        return OrderItemResource::collection(
                    OrderItem::getOrderItems($orderId)
                    ->with('product')
                    ->get());
    }
    public function orderStatus()
    {
        return  OrderResource::collection(
                        Order::getOrderByStatus($_GET['status'])
                        ->with('orderItems.product')
                        ->get());
    }
    public function returnItem(Request $request,ReturnItemService $returnItem)
    {
        $returnItem = $returnItem;
       return  $returnItem->returnItem($request);  
    }
  
    

    
}

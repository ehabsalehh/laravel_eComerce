<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderItem;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Requests\ReturnItemRequest;
use App\Http\Resources\OrderItemResource;
use App\Services\Order\ReturnItemService;
use App\Http\Requests\UpdatedOrderRequest;
use App\Http\Traits\Order\UpdateOrderStausTrait;


class OrderController extends Controller
{
    use UpdateOrderStausTrait;
    
        private $returnItem;
        private $decreaseQuantity;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return  OrderResource::collection(Order::getStatusNewOrder()->with('orderItems.product')->paginate(2));
    }
    public function getOrderItems($orderId){
        return OrderItemResource::collection(OrderItem::getOrderItems($orderId)->with('product')->get());
    }
    
    // return order based on status
    public function order_status($status)
    {
        // return Order::getOrderByStatus($status)->with('orderItems.product')->get();
        return  OrderResource::collection(Order::getOrderByStatus($status)->with('orderItems.product')->get());
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
    public function updateStatus(UpdatedOrderRequest $request,Order $order)
    {
        return $this->updateOrderStaus($request,$order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        return $order->delete();
    }
    public function return_item(ReturnItemRequest $request,ReturnItemService $returnItem)
    {
        $this->returnItem = $returnItem;
       return  $this->returnItem->returnItem($request);  
    }
  
    

    
}

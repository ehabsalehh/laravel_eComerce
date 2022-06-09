<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderItem;
use App\services\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderItemResource;
use App\Http\Requests\UpdatedOrderRequest;
use App\Http\Traits\Order\CancelOrderStausTrait;
use App\Http\Traits\Order\UpdateOrderStausTrait;


class OrderController extends Controller
{
    use UpdateOrderStausTrait,
        CancelOrderStausTrait
    ;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  OrderResource::collection(Order::getStatusNewOrder()->with('orderItems')->paginate(2));
    }
    public function getOrderItems($orderId){
        return OrderItemResource::collection(OrderItem::getOrrderItems($orderId)->get());
    }
    
    // return order based on status
    public function order_status($status)
    {
        return  OrderResource::collection(Order::GetOrderByStatus($status)->with('orderItems')->get());
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( Order $order)
    {
        return new OrderResource($order->with('orderItems')->first());
    }    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatedOrderRequest $request)
    {
        return $this->updateOrderStaus($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        return $this->cancelOrderStaus($order);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Carbon;
use App\Services\Order\OrderTrack;
use App\Services\Order\ReturnItem;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Services\Order\OrderCalculator;
use App\Http\Requests\ReturnItemRequest;
use App\Http\Resources\OrderItemResource;
use App\Services\Order\ReturnItemService;
use App\Http\Requests\UpdatedOrderRequest;
use App\Http\Traits\Order\ReturnItemTrait;
use App\Http\Interface\OrderTrackerInterface;
use App\Http\Traits\Order\CancelOrderStausTrait;
use App\Http\Traits\Order\UpdateOrderStausTrait;
use App\Http\Traits\OrderItem\GetOrderItemTrait;
use App\Services\Order\DecreaseInventoryQuantityService;

class OrderController extends Controller
{
    use UpdateOrderStausTrait,
        CancelOrderStausTrait,
        ReturnItemTrait
    ;
    
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
        return OrderItemResource::collection(OrderItem::getOrrderItems($orderId)->with('product')->get());
    }
    
    // return order based on status
    public function order_status($status)
    {
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
        $created = new Carbon($order->created_at);
        $now = Carbon::now();
        $difference = ($created->diff($now)->days < 1)
            ? 'today'
            : $created->diffForHumans($now);
        return $difference;

        return new OrderResource($order->with('orderItems.product')->first());
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
    public function return_item(ReturnItemRequest $request,ReturnItemService $returnItem)
    {
        $this->returnItem = $returnItem;
       return  $this->returnItem->returnItem($request);  
    }
    // in case not decrease in placeorder
    public function decreaseQuantity(Request $request,DecreaseInventoryQuantityService $decreaseQuantity){
        $this->decreaseQuantity = $decreaseQuantity;
        return $this->decreaseQuantity->decreaseQuantity($request);   
    }
    

    
}

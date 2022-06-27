<?php

namespace App\Http\Controllers\Customer;

use App\Models\Order;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\services\ResponseMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\OrderResource;
use App\Http\Requests\ChangePasswordRequest;
use App\Services\Auth\ChangeCustomerPassword;
use App\Http\Traits\Order\CancelOrderStausTrait;
use App\Http\Requests\UpdateCustomerProfileRequest;

class HomeController extends Controller
{
    use CancelOrderStausTrait;
    private $changePassword;
    public function ChangeCustomerPassword(ChangePasswordRequest $Request,ChangeCustomerPassword $changePassword){
        $this->changePassword = $changePassword;
       return  $this->changePassword->changePassword($Request);
    }
    public function profile(){
       return Auth()->user();
    }
    public function profileUpdate(UpdateCustomerProfileRequest $request, Customer $customer){
        $customer->update($request->validated());
        return ResponseMessage::succesfulResponse();
    }
    public function orderIndex(){
        return  Order::where('orders.customer_id',Auth::id())
        ->orderByDesc('orders.id')
        ->with('orderItems')->paginate(10);
    }
    public function productTrackOrder(Request $request){
        $order=Order::where('customer_id',auth()->user()->id)->where('order_number',$request->order_number)->first();
        if(empty($order)){return Response()->json('Invalid order numer please try again');}
        $messageTracks = [
            'new' => 'Your order has been placed. please wait.',
            'process' => 'Your order is under processing please wait..',
            'delivered'=> 'Your order is successfully delivered.',
            'cancel' => 'Your order canceled. please try again.',
        ];
        return  Response()->json($messageTracks[$order->status]);

    }
    public function customerOrderDelete(Order $order){
        $this->authorize('delete', $order);
        if($order->status =='new'){
            return $this->cancelOrderStaus($order);
        }
        return ;
    }

    
}

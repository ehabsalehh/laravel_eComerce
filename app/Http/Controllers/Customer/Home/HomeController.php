<?php

namespace App\Http\Controllers\Customer\Home;
use App\Models\Customer\Checkout\Order;use App\Models\Customer\Customer;
use Illuminate\Http\Request;
use App\services\ResponseMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ChangePasswordRequest;
use App\Services\Auth\ChangeCustomerPassword;
use App\Http\Requests\UpdateCustomerProfileRequest;

class HomeController extends Controller
{
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
        return ResponseMessage::successResponse();
    }
    public function orderIndex(){
        return  Order::where('orders.customer_id',Auth::id())
        ->orderByDesc('orders.id')
        ->with('orderItems')->paginate(10);
    }
    public function trackOrder(Request $request){
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
    public function orderDelete($orderId){
        $order = Order::findOrFail($orderId);
         $this->authorize('delete', $order);
        if($order->status =='new'){
            $order->delete();
        }
    }

    
}
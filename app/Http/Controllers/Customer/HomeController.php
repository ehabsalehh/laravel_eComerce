<?php

namespace App\Http\Controllers\Customer;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\services\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Models\Customer\Checkout\Cart;
use App\Models\Customer\Checkout\Order;
use App\Models\Customer\Review\WishList;
use App\Http\Requests\UpdateCustomerProfileRequest;
use App\Services\Customer\Home\ChangeCustomerPassword;

class HomeController extends Controller
{
    private $changePassword;
    public function ChangeCustomerPassword( Request $Request,ChangeCustomerPassword $changePassword){
        $this->changePassword = $changePassword;
       return  $this->changePassword->changePassword($Request);
    }
    public function profile(){
       return auth()->user();
    }
    public function profileUpdate(UpdateCustomerProfileRequest $request, Customer $customer){
        $customer->update($request->validated());
        return ResponseMessage::successResponse();
    }
    public function orderIndex(){
        return  Order::where('orders.customer_id',auth()->id())
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
        return  Response()->json(data_get($messageTracks,$order->status));


    }
    public function orderDelete(Order $order){
         $this->authorize('delete', $order);
        if($order->status =='new'){
            $order->delete();
        }
    }
    public function wishlistCount(){
        return  WishList::getCustomerWishList()->count();
    }
    public function CartCount(){
        return  Cart::CustomerId(auth()->id())->count();
     }

    
}

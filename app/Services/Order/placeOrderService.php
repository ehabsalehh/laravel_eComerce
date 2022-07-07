<?php
namespace App\services\Order;

use App\Models\Admin;
use App\Models\Payment;
use App\services\ResponseMessage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isNull;
use App\Notifications\OffersNotification;

use App\Http\Traits\Order\CreateOrderTrait;
use Illuminate\Support\Facades\Notification;
use App\Http\Traits\Payment\PaidPaymentTrait;
use App\Http\Traits\Cart\GetCustomerCartTrait;
use App\Http\Traits\Payment\UnPaidPaymentTrait;
use App\Http\Traits\Cart\DestroyCustomerCartTrait;
use App\Http\Traits\Order\ProccessTransactionTrait;
use App\Http\Traits\OrderItem\CreateOrderItemTrait;
use App\Services\Order\ProccessTransaactionService;
use App\Http\Traits\Product\DecreseInventoryQuantityTrait;

class placeOrderService{
    use CreateOrderTrait

        ;
    public function placeOrder($request){
        try {
            DB::beginTransaction();
            $order = $this->CreateOrder($request);
            $admin=Admin::get();
            $details=[
                'title'=>'New order created',
            ];
            // $admin->notify(new OffersNotification($details));
            Notification::send($admin, new OffersNotification($details));
            session()->forget('couponPercent');           
            DB::commit();
            request()->session()->flash('success','order successfully applied');
            return to_route('viewCheckOut');
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }  
    }
    
}
<?php
namespace App\services\Order;

use App\Models\Payment;
use App\services\ResponseMessage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isNull;
use App\Http\Traits\Order\CreateOrderTrait;
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
         $request->all();
        try {
            DB::beginTransaction();
            $this->CreateOrder($request);           
            DB::commit();
            return to_route('createTransaction');
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }  
    }
    
}
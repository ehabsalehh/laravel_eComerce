<?php

namespace App\Http\Traits\Order;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\OrderItem\GetOrderItemsProductTrait;

trait verifiedPurchaseOrderTrait
{
    use GetOrderItemsProductTrait;
    protected  function verifiedPurchaseOrder($product_id){
        $userOrderitems = $this->GetOrderItemsProduct($product_id);
       return  DB::table('orders')->where('orders.user_id',Auth::id())
            ->joinSub($userOrderitems, 'order_items', function ($join) {
                $join->on('orders.id', '=', 'order_items.order_id');
            })->get();
    }

}

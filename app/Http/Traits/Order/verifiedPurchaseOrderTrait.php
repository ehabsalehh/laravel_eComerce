<?php

namespace App\Http\Traits\Order;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

trait verifiedPurchaseOrderTrait
{
    protected  function verifiedPurchaseOrder($product_id){
        return  DB::table('order_items')->where('product_id',$product_id)
                ->where('customer_id',Auth::id())->get();
    }

}

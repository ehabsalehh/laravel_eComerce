<?php

namespace App\Services\Employee\Order;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VerifiedPurchaseOrder
{
    public  function verifiedPurchaseOrder($product_id){
        return  DB::table('order_items')->where('product_id',$product_id)
                ->where('customer_id',auth()->id())->get();
    }

}

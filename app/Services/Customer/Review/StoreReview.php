<?php

namespace App\Services\Review;
use App\Models\Admin\Admin;
use App\Models\Customer\Review\Review;
use Illuminate\Support\Facades\Auth;
use App\Notifications\OffersNotification;
use Illuminate\Support\Facades\Notification;
class StoreReview
{
    public function store($request,$verifiedPurchaseOrder){
        if(empty($verifiedPurchaseOrder->verifiedPurchaseOrder($request->product_id))){return ;}
        $validated = $request->validate([
            'product_id'=>["required","exists:products,id"],
            'customer_review' => ['required','string']
        ]);
        $validated['customer_id'] =Auth::id();
        Review::create($validated);
        $admin=Admin::get();
        $details=[
            'title'=>'New Product Review'
        ];
        Notification::send($admin, new OffersNotification($details));
    }
}

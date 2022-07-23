<?php

namespace App\Services\Customer\Review;
use App\Models\Admin;
use App\Models\Customer\Review\Review;
use App\Notifications\OffersNotification;
use Notification;
class StoreReview
{
    public function store($request,$verifiedPurchaseOrder){
        if(empty($verifiedPurchaseOrder
                    ->verifiedPurchaseOrder($request->product_id))){return ;}
        $validated = $request->validate([
            'product_id'=>["required","exists:products,id"],
            'customer_review' => ['required','string']
        ]);
        $validated['customer_id'] =auth()->id();
        Review::create($validated);
        $admin=Admin::get();
        $details=[
            'title'=>'New Product Review'
        ];
        Notification::send($admin, new OffersNotification($details));
    }
}

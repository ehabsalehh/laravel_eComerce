<?php

namespace App\Services\Review;

use App\Models\Admin;
use App\Models\Review;
use App\services\ResponseMessage;
use Illuminate\Support\Facades\Auth;
use App\Notifications\OffersNotification;
use Illuminate\Support\Facades\Notification;
use App\Http\Traits\Review\CreateReviewTrait;
use App\Http\Traits\Order\verifiedPurchaseOrderTrait;

class AddReview
{
    use verifiedPurchaseOrderTrait
    ;
    private $data;
    public function addReview($request){
        if(empty($this->verifiedPurchaseOrder($request->product_id))){
            return ;
        }
        $this->data = $request->validated();
        $this->data['customer_id'] =Auth::id();
        Review::create($this->data);
        $admin=Admin::get();
        $details=[
            'title'=>'New Product Review'
        ];
        // $admin->notify(new OffersNotification($details));
        Notification::send($admin, new OffersNotification($details));

    }

}

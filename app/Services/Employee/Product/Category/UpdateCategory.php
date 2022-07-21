<?php
namespace App\Services\Employee\Product\Category;
use App\services\ResponseMessage;
use App\Models\Admin\Notification;
use App\Models\Employee\Product\Category;
use App\Notifications\OffersNotification;

class UpdateCategory
{
    public function update($request,Category $category){
        try {
            $category->update($request->validated());
            $details=[
                'title'=>'New  updated  category ',
            ];
            Notification::send($category, new OffersNotification($details));
            $category->clearMediaCollection('Categories');
            $category->addMediaFromRequest('images')
                        ->toMediaCollection('Categories');    
            return ResponseMessage::successResponse();   
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

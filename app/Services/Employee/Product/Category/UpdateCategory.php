<?php
namespace App\Services\Employee\Product\Category;
use App\Models\Admin;
use App\services\ResponseMessage;
use App\Models\Employee\Product\Category;
use App\Notifications\OffersNotification;
use Notification;

class UpdateCategory
{
    public function update($request,Category $category){
        try {
            $category->update($request->validated());
            $admin=Admin::get();
            $details=[
                'title'=>'New  updated  category ',
            ];
            Notification::send($admin, new OffersNotification($details));
            if($request->images){
                $category->clearMediaCollection('Categories');
                $category->addMediaFromRequest('images')
                        ->toMediaCollection('Categories');    
            }
        return ResponseMessage::successResponse();   
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

<?php
namespace App\Services\Employee\Product\Category;
use Illuminate\Support\Str;
use App\services\ResponseMessage;
use App\Models\Admin\Notification;
use App\Models\Employee\Product\Category;
use App\Notifications\OffersNotification;

class StoreCategory
{
    public function store($request){
        try {
            $data= $request->validated();
            $data['slug']=Str::slug($request->name).'-'.date('ymdis');
            $data['is_parent']=$request->input('is_parent',0);
            $category = Category::create($data);
            $details=[
                'title'=>'New Category created',
            ];
            Notification::send($category, new OffersNotification($details));
            $category->addMediaFromRequest('images')
                        ->toMediaCollection('Categories');
            return ResponseMessage::successResponse();
        } catch (\Throwable $th) {
            throw $th;
        }
     
    }
}

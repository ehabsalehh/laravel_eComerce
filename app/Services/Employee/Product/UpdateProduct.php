<?php
namespace App\Services\Employee\Product;

use App\Models\Admin;
use Illuminate\Support\Str;
use App\services\ResponseMessage;
use Notification;
use App\Models\Employee\Product\Product;
use App\Notifications\OffersNotification;
use App\Models\Employee\Product\Inventory;

class UpdateProduct
{    
    public function update($request,Product $product)
    {
        try {
            $data=$request->except(['quantity','location_id']);
            $data['slug'] =Str::slug($request->name).'-'.date('ymdis');        
            $product->update($data);
            $admin=Admin::get();
            $details=[
                'title'=>'New  updated  Product ',
            ];
            Notification::send($admin, new OffersNotification($details));
            $product->clearMediaCollection('images');
            $product->addMediaFromRequest('images')
                    ->toMediaCollection('images');
            $inventory = Inventory::where('product_id',$product->id)->first();
            $inventory->update($request->only(['quantity','location_id'])); 
            return ResponseMessage::successResponse();   
        } catch (\Throwable $th) {
            throw $th;
        }
    }    
}

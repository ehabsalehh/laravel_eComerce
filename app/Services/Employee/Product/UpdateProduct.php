<?php
namespace App\Services\Employee\Product;

use Illuminate\Support\Str;
use App\services\ResponseMessage;
use App\Models\Admin\Notification;
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
            $details=[
                'title'=>'New  updated  Product ',
            ];
            Notification::send($product, new OffersNotification($details));
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

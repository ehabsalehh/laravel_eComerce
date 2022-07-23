<?php
namespace App\Services\Employee\Product;
use App\Models\Admin;
use Illuminate\Support\Str;
use App\services\ResponseMessage;
use Notification;
use Illuminate\Support\Facades\DB;
use App\Models\Employee\Product\Product;
use App\Notifications\OffersNotification;
use App\Models\Employee\Product\Inventory;

class StoreProduct
{
    public function store($request){
        try {
            DB::beginTransaction();
            $product=$request->except(['quantity','location_id']);
            $product['slug'] =Str::slug($request->name).'-'.date('ymdis');        
            $product =Product::create($product);
            $admin=Admin::get();
            $details=[
                'title'=>'New product created',
            ];
            Notification::send($admin, new OffersNotification($details));
            $product->addMediaFromRequest('images')
                    ->toMediaCollection('images');
            $inventory = $request->only(['quantity','location_id']);
            $inventory['product_id'] = $product->id;
            Inventory::create($inventory);
            DB::commit();
            return ResponseMessage::successResponse();
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
        
    }

}

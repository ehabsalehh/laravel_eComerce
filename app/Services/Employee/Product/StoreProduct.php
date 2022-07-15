<?php

namespace App\Services\product;

use App\Models\Employee\Product\Product;
use Illuminate\Support\Str;
use App\services\ResponseMessage;
use App\Http\Traits\handleFile\UploadProductFileTrait;
use App\Models\Employee\Product\Inventory;
class StoreProduct
{
    private $product;
    private $inventory;
    public function store($request){
        $this->product=$request->except(['quantity','location_id']);
        $this->product['slug'] =Str::slug($request->name).'-'.date('ymdis');        
        $this->product['photo'] = $this->uploadProductFile($request);
        $product =Product::create($this->product);
        $this->inventory = $request->only(['quantity','location_id']);
        $this->inventory['product_id'] = $product->id;
        Inventory::create($this->inventory);
        return ResponseMessage::successResponse();
    }
    private function uploadProductFile($request)
    {
        $fileName = $request->file('photo')->getClientOriginalName(); 
        $request->file('photo')->storeAs('attachments/Products',$fileName,'upload_attachments');
        return $fileName;
    }

}

<?php

namespace App\Services\product;

use App\Models\Product;
use Illuminate\Support\Str;
use App\services\ResponseMessage;
use App\Http\Traits\handleFile\UploadProductFileTrait;
use App\Models\Inventory;

class StoreProduct
{
    use UploadProductFileTrait;
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
        return ResponseMessage::succesfulResponse();
    }

}

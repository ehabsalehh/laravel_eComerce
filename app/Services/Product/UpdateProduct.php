<?php

namespace App\Services\Product;

use App\Models\Product;
use Illuminate\Support\Str;
use App\services\ResponseMessage;
use App\Http\Traits\handleFile\UpdateProductPhotoTrait;
use App\Http\Traits\handleFile\ChangeProductLocalFileTrait;
use App\Models\Inventory;

class UpdateProduct
{
    use UpdateProductPhotoTrait;
    private $product;
    private $inventory;
    public function update($request,Product $product)
    {
        try {
            $this->product=$request->except(['quantity','location_id']);
            $this->product['slug'] =Str::slug($request->name).'-'.date('ymdis');        
            $this->product['photo'] = $this->updateProductPhoto($request,$product->photo);
            $product->update($this->product);
            $this->inventory = Inventory::where('product_id',$product->id)->first();
            $this->inventory->update($request->only(['quantity','location_id'])); 
            return ResponseMessage::succesfulResponse();   
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    

}

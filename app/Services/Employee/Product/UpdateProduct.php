<?php
namespace App\Services\Product;
use Illuminate\Support\Str;
use App\services\ResponseMessage;
use App\Models\Employee\Product\Product;
use App\Models\Employee\Product\Inventory;
use App\Http\Traits\handleFile\DeleteFileTrait;
use App\Http\Traits\handleFile\UploadFileTrait;
class UpdateProduct
{
    private $product;
    private $inventory;
    private $currentImage;
    private $newImage;
    use
        DeleteFileTrait,
        UploadFileTrait;
    public function update($request,Product $product)
    {
        try {
            $this->product=$request->except(['quantity','location_id']);
            $this->product['slug'] =Str::slug($request->name).'-'.date('ymdis');        
            $this->product['photo'] = $this->updateProductPhoto($request,$product->photo);
            $product->update($this->product);
            $this->inventory = Inventory::where('product_id',$product->id)->first();
            $this->inventory->update($request->only(['quantity','location_id'])); 
            return ResponseMessage::successResponse();   
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    
    private function updateProductPhoto($request,$photo){
        $this->currentImage = $photo;
        $this->newImage = $request->file('photo')->getClientOriginalName();
        $this->changeProductLocalFile($request,$this->currentImage,$this->newImage);
        return  ($this->currentImage !== $this->newImage) ? $this->newImage : $this->currentImage;
            
    }
    private function changeProductLocalFile($request){
        if($this->currentImage !== $$this->newImage){
            $this->deleteFile($this->currentImage,'Products');
            $this->uploadFile($request,'photo','Products');
        }
    }
    

}

<?php

namespace App\Http\Traits\handleFile;

trait UpdateProductPhotoTrait
{
    use ChangeProductLocalFileTrait
    ;
    private $currentImage;
    private $image;
    public function updateProductPhoto($request,$photo){
        $this->currentImage = $photo;
        $this->image = $request->file('photo')->getClientOriginalName();
        $this->changeProductLocalFile($request,$this->currentImage,$this->image);
        return  ($this->currentImage !== $this->image) ? $this->image : $this->currentImage;
            
    }    
}


   
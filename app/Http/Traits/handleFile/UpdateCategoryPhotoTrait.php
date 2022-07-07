<?php

namespace App\Http\Traits\handleFile;

use App\Models\Customer;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

trait UpdateCategoryPhotoTrait
{
    use ChangeCategoryLocalFileTrait
    ;
    private $currentImage;
    private $image;
    public function updateCategoryPhoto($request,$photo){
        if($request->hasFile('photo')){
            $this->currentImage = $photo;
            $this->image = $request->file('photo')->getClientOriginalName();
            $this->changeCategoryLocalFile($request,$this->currentImage,$this->image);
            return  ($this->currentImage !== $this->image) ? $this->image : $this->currentImage;
        }        
    }    
}


   
<?php
namespace App\Services\Employee\Product\Category;
use App\services\ResponseMessage;
use App\Models\Employee\Product\Category;
use App\Http\Traits\handleFile\DeleteFileTrait;
use App\Http\Traits\handleFile\UploadFileTrait;
use App\Http\Traits\handleFile\UpdateCategoryPhotoTrait;
use App\Http\Traits\handleFile\ChangeCategoryLocalFileTrait;

class UpdateCategory
{
    private $currentImage;
    private $newImage;
    use 
        DeleteFileTrait,
        UploadFileTrait;
    public function update($request,Category $category){
        try {
            $validated= $request->validated();
            if(!$request->hasFile('photo')){
                $category->update($validated);    
                return ResponseMessage::successResponse();       
            }       
            $this->currentImage = $category->photo;
            $this->newImage = $request->file('photo')->getClientOriginalName();
            $photo = $this->changeCategoryLocalFile($request,$this->currentImage,$this->newImage);
            $validated['photo'] = $photo;
            $category->update($validated);    
            return ResponseMessage::successResponse();   
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    private function changeCategoryLocalFile($request){
        if($this->currentImage !== $this->newImage){
            $this->deleteFile($this->currentImage,'Categories');
            $this->uploadFile($request,'photo','Categories');
            return $this->newImage;
        }
        return $this->currentImage;
    }

}

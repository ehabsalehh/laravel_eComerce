<?php
namespace App\Services\Employee\Product\Category;
use App\Http\Traits\handleFile\UploadCategoryFileTrait;
use App\Models\Employee\Product\Category;
use App\services\ResponseMessage;
use Illuminate\Support\Str;

class StoreCategory
{
    private $data;
    public function store($request){
        try {
            $this->data= $request->validated();
            $this->data['slug']=Str::slug($request->name).'-'.date('ymdis');
            $this->data['photo'] = $this->uploadCategoryFile($request);
            $this->data['is_parent']=$request->input('is_parent',0);
            Category::create($this->data);
            return ResponseMessage::successResponse();
        } catch (\Throwable $th) {
            throw $th;
        }
     
    }
    private function uploadCategoryFile($request)
    {
        if($request->file('photo')){
            $fileName = $request->file('photo')->getClientOriginalName(); 
            $request->file('photo')->storeAs('attachments/Categories',$fileName,'upload_attachments');
            return $fileName;
        }
    }

}

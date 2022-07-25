<?php

namespace App\Http\Controllers\Employee\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\services\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use Illuminate\Validation\Rules\Enum;
use App\Models\Employee\Product\Brand;
use App\Http\Requests\StoredBrandRequest;
use App\Enums\Employee\Product\BrandStatus;

class BrandController extends Controller
{
    private $data;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BrandResource::collection(Brand::get());
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated= $request->validate($this->rules());
        $this->data =$validated; 
        $this->data['slug'] = Str::slug($request->name).'-'.date('ymdis');
        Brand::create($this->data);
        return ResponseMessage::successResponse();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        return new BrandResource($brand);
    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Brand $brand)
    {
        $validated= $request->validate($this->rules());
        $this->data =$validated; 
        $brand->update($this->data);
        return ResponseMessage::successResponse(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return ResponseMessage::successResponse(); 
    }
    private function rules()
    {
        return [
            'name'=>["string",'required'],
            'slug' =>['string'],
            'status'=> [new Enum(BrandStatus::class)],
        ];
    }
}

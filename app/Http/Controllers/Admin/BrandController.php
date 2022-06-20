<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Services\Brand\StoreBrand;
use App\Services\Brand\UpdateBrand;
use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Services\Brand\BrandStructure;
use App\Http\Requests\StoredBrandRequest;
use App\Services\Brand\BrandData;
use App\services\ResponseMessage;

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
    public function store(StoredBrandRequest $request,BrandData $BrandData)
    {
        $this->data = $BrandData;
        Brand::create($this->data->getData($request));
        return ResponseMessage::succesfulResponse();
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
    public function update(StoredBrandRequest $request,BrandData $brandData,Brand $brand)
    {
        $this->data =$brandData;
        $brand->update($this->data->getData($request));
        return ResponseMessage::succesfulResponse(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        return $brand->delete($brand);
    }
}

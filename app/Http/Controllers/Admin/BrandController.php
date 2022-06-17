<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Services\Brand\StoreBrand;
use App\Services\Brand\UpdateBrand;
use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Services\Brand\BrandStructure;
use App\Http\Requests\StoredBrandRequest;

class BrandController extends Controller
{
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
    public function store(StoredBrandRequest $request)
    {

        $addToBrand = new StoreBrand(new BrandStructure);
        return $addToBrand->store($request);
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
    public function update(StoredBrandRequest $request)
    {

        $updateBrand = new UpdateBrand(new BrandStructure);
        return $updateBrand->update($request);   
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

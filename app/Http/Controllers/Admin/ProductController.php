<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\services\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Traits\AttachFilesTrait;
use App\Http\Resources\ProductResource;
use App\Http\Requests\storedProductRequest;
use App\Http\Traits\handleFile\CreateModelWithFileTrait;
use App\Http\Traits\handleFile\UpdateModelWithFileTrait;

class ProductController extends Controller
{
     use CreateModelWithFileTrait,
     UpdateModelWithFileTrait
 
    ;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  ProductResource::collection(Product::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storedProductRequest $request,Product $product)
    {
        return $this->createModelWithFile($request,$product,'photo','products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(storedProductRequest $request,Product $product)
    {
        return $this->updateModelWithlFile($request,$product,$product->photo,'photo','products');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        // Delete img in server disk
        $this->deleteFile($product->photo,'products');
        $product->delete();
        return ResponseMessage::succesfulResponse();
    }
    
}

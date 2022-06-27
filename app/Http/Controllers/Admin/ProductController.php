<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\services\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Requests\storedProductRequest;
use App\Http\Traits\handleFile\CreateModelWithFileTrait;
use App\Http\Traits\handleFile\UpdateModelWithFileTrait;
use App\Services\product\StoreProduct;
use App\Services\Product\UpdateProduct;

class ProductController extends Controller
{
    private $store;
    private $update;
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
        return  ProductResource::collection(Product::ProductWith()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storedProductRequest $request,StoreProduct $store)
    {
        $this->store = $store;
        return $this->store->store($request);
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
    public function update(storedProductRequest $request,UpdateProduct $updateProduct,Product $product)
    {
        $this->update = $updateProduct;
        return $this->update->update($request,$product);

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

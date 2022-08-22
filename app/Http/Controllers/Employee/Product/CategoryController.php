<?php

namespace App\Http\Controllers\Employee\Product;

use App\services\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Employee\Product\Category;
use App\Http\Requests\storedCategoryRequest;
use App\Services\Employee\Product\Category\StoreCategory;
use App\Services\Employee\Product\Category\UpdateCategory;

class CategoryController extends Controller
{
    private $store;
    private $updateCategory;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return  CategoryResource::collection(Category::get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storedCategoryRequest $request, StoreCategory $StoreCategory){
        $this->store = $StoreCategory;
        return $this->store->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function update(storedCategoryRequest $request,Category $category,UpdateCategory $updateCategory)
    {
        $this->updateCategory = $updateCategory;
        return $this->updateCategory->update($request,$category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->clearMediaCollection('images');
        $category->delete();
    
        return ResponseMessage::successResponse();
    }
    
}

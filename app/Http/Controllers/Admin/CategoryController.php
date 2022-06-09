<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;
use App\services\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;

use App\Http\Requests\storedCategoryRequest;

use App\Http\Traits\handleFile\CreateModelWithOptionalFileTrait;
use App\Http\Traits\handleFile\UpdateModelWithOptionalFileTrait;

class CategoryController extends Controller
{
    use UpdateModelWithOptionalFileTrait,
        CreateModelWithOptionalFileTrait
    ;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  CategoryResource::collection(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storedCategoryRequest $request,Category $category)
    {
         return $this->createModelWithOptionalFile($request,$category,'photo','categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( category $category)
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
    public function update(storedCategoryRequest $request,Category $category)
    {
        return $this->updateModelWithOptionalFile($request,$category,$category->photo,'photo','categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // Delete img in server disk
        $this->deleteFile($category->photo,'categories');   
        $category->delete();
        return ResponseMessage::succesfulResponse();
    }
    
}

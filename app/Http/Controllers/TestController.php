<?php

namespace App\Http\Controllers;

use App\Models\test;
use App\Http\Traits\AttachFilesTrait;
use App\Http\Requests\StoretestRequest;
use App\Http\Requests\UpdatetestRequest;

class TestController extends Controller
{
    use AttachFilesTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoretestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoretestRequest $request)
    {
        try {
            $data = $request->all();
            $data['photo'] = $request->file('photo')->getClientOriginalName();
            $product =test::create($data);
            $this->uploadFile($request,'photo','test');
            return ["sucees"=>"success"];
        } catch (\Exception $exception) {
            return  $exception->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(test $test)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(test $test)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatetestRequest  $request
     * @param  \App\Models\test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatetestRequest $request, test $test)
    {
        try {

            $data = $request->all();
            $file_name_new = $request->file('photo')->getClientOriginalName();
            $data["photo"] = ($test->photo !== $file_name_new) ? $file_name_new : $test->photo;
            if($test->photo !== $file_name_new){
                $this->deleteFile($test->photo,'test');
                $this->uploadFile($request,'photo','test');
            }
            $test->update($data);
            return ['sucess'=>'sucess'];
        } catch (\Exception $exception) {
            return  $exception->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(test $test)
    {
        //
    }
}

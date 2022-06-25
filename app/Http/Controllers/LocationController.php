<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeLocationRequest;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use App\services\ResponseMessage;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return LocationResource::collection(Location::get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeLocationRequest $request)
    {
        Location::create($request->validated());
        return ResponseMessage::succesfulResponse();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        return new LocationResource($location);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(storeLocationRequest $request,Location $location)
    {
        $location->update(['name',$request->name]);
        return ResponseMessage::succesfulResponse();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        $location->delete();
        return ResponseMessage::succesfulResponse();
    }
}

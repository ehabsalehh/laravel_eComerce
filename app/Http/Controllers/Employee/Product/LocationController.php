<?php

namespace App\Http\Controllers\Employee\Product;
use App\Http\Controllers\Controller;
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
    public function store(Request $request)
    {
        $validated= $request->validate($this->rules());
        Location::create($validated);
        return ResponseMessage::successResponse();
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
    public function update(Request $request,Location $location)
    {
        $validated= $request->validate($this->rules());
        $location->update($validated);
        return ResponseMessage::successResponse();
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
        return ResponseMessage::successResponse();
    }
    private function rules()
    {
        return [
            'name'=>['required','string']
        ];
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coupon;
use App\services\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Resources\couponResource;
use App\Http\Requests\StoredCouponRequest;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return couponResource::collection(Coupon::get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoredCouponRequest $request)
    {
        coupon::create($request->validated());
        return ResponseMessage::succesfulResponse();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(coupon $coupon)
    {
        return new couponResource($coupon);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoredCouponRequest $request,coupon $coupon)
    {
        $coupon->update($request->validated());
        return ResponseMessage::succesfulResponse();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(coupon $coupon)
    {
        return $coupon->delete();
    }
    
}

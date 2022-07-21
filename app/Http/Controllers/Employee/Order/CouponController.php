<?php
namespace App\Http\Controllers\Employee\Order;
use App\Models\Employee\Order\Coupon;
use App\services\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Resources\couponResource;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        $validated= $request->validate($this->rules());
        coupon::create($validated);
        return ResponseMessage::successResponse();
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
    public function update(Request $request,coupon $coupon)
    {
        $validated= $request->validate($this->rules());
        $coupon->update($validated);
        return ResponseMessage::successResponse();
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
    private function rules()
    {
        return [
            'code'=>['string','required'],
            'percent'=>['required','numeric'],
            'status'=>['required','in:active,inactive']
        ];
    }
    
}

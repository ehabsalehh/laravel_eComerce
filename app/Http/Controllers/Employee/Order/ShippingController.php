<?php
namespace App\Http\Controllers\Employee\Order;
use App\Http\Controllers\Controller;
use App\Http\Resources\ShippingResource;
use App\Http\Resources\SupplierResource;
use App\Models\Employee\Order\Shipping;
use App\services\ResponseMessage;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SupplierResource::collection(Shipping::get());
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
        Shipping::create($validated);
        return ResponseMessage::successResponse();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Shipping $shipping)
    {
        return new ShippingResource($shipping);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shipping $shipping)
    {
        $validated= $request->validate($this->rules());
        $shipping->update($validated);
        return ResponseMessage::successResponse();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shipping $shipping)
    {
        $shipping->delete();
        return ResponseMessage::successResponse();
    }
    private function rules()
    {
        return [
            'name' => ['string','required'],
            'price' =>['required','numeric'],
            'phone' => ['string','required','digits:11'],
            'status'=> ["required","in:active,inactive"],
        ];
    }
}

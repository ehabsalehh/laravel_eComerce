<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDisountRequest;
use App\Models\Discount;
use App\services\ResponseMessage;
use Illuminate\Http\Request;

class DiscountTController extends Controller
{
    public function store(StoreDisountRequest $request)
    {
        Discount::create($request->validated());
        return ResponseMessage::succesfulResponse();
    }
    public function update(StoreDisountRequest $request,Discount $discount){
        $discount->update($request->validated());
        return ResponseMessage::succesfulResponse();
    }
}

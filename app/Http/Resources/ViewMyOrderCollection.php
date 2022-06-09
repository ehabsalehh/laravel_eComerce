<?php

namespace App\Http\Resources;

use App\Http\Resources\OrderItemResource;
use App\Models\OrderItem;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ViewMyOrderCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'order_number' => $this->order_number,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'country' => $this->country,
            'post_code' => $this->post_code,
            'orderItems' => OrderItemResource::collection($this->orderItems),
            
            'orderItemCount' => $this->orderItems->count(),
        ];

        // return $this->collection->transform(function ($item) {
        //             });
    }
}

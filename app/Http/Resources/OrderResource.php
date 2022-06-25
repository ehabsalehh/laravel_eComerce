<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'order_number' => $this->order_number,
            'status' => $this->status,
            'sub_total' => $this->sub_total,
            'total_discount' => $this->total_discount,
            'total' => $this->total,
            'orderItems' => OrderItemResource::collection($this->orderItems),
            
            'orderItemCount' => $this->orderItems->count(),
        ];
    }
}

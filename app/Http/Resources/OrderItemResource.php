<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
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
            'product' => $this->product->name,
            'customer_id' =>$this->customer->first_name.$this->customer->last_name,
            'quantity' =>$this->quantity,
            'order_id' =>$this->order_id,
        ];
    }
}

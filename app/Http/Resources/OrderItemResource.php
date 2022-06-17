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
            'product' => $this->product->name,
            // 'product' => PostResource::collection($this->whenLoaded('posts')),
            'id'=>$this->id,
            'product_id' =>$this->product_id,
            'customer_id' =>$this->customer_id,
            'product_quantity' =>$this->product_quantity,
            'order_id' =>$this->order_id,
            'price' =>$this->price,
        ];
    }
}

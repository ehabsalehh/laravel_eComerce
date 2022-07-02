<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class cartResource extends JsonResource
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
            'product_id' =>$this->product_id,
            'customer_id' =>$this->customer_id,
            'product_quantity' =>$this->product_quantity,
            'customers' => $this->whenloaded('customer'),
            'product_name' => $this->whenloaded('product'),
        ];
    }
}

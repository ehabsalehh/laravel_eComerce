<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'name' =>$this->name,
            'slug' =>$this->slug,
            'description' =>$this->description,
            'photo' =>$this->photo,
            'status' =>$this->status,
            'products' =>$this->whenLoaded('products'),
            'subproducts' =>$this->whenLoaded('sub_products'),

        
            // 'products' => ProductResource::collection($this->whenLoaded('products'))
        ];
    }
}
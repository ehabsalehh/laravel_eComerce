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
            'popular' =>$this->popular,
            'status' =>$this->status,
            'meta_title' =>$this->meta_title,
            'meta_description' =>$this->meta_description,
            'meta_keywords' =>$this->meta_keywords,
            // 'products' => ProductResource::collection($this->whenLoaded('products'))
            'products' => ProductResource::collection($this->whenLoaded('products'))

            // 'products' => $this->products?$this->products->name:'null',

        ];
    }
}
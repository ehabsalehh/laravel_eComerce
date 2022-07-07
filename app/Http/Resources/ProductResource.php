<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'small_description' =>$this->small_description,
            'description' =>$this->description,
            'price' =>$this->price,
            'size' =>$this->size,
            'color' =>$this->color,
            'photo' =>$this->photo,
            'tax' =>$this->tax,
            'discount'=>$this->whenLoaded('discount'),
            'status' =>$this->status,
            'parent_category' => $this->whenLoaded('category'),
            'sub_category' => $this->whenLoaded('sub_category'),
            'rating' => $this->whenLoaded('rating'),
            'Review' => $this->whenLoaded('review'),
            // 'Reviews' => $this->rating

            // 'rating_number' => $this->whenLoaded('rating')?$this->rating->count():null,
            // 'rating_avg' => $this->whenLoaded('rating')?$this->rating->sum('stars_rated')/$this->rating->count():null,

        ];
    }
}

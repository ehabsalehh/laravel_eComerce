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
            'original_price' =>$this->original_price,
            'selling_price' =>$this->selling_price,
            'photo' =>$this->photo,
            'quantity' =>$this->quantity,
            'tax' =>$this->tax,
            'popular' =>$this->popular,
            'status' =>$this->status,
            'category_name' => $this->category->name,
            'meta_title' =>$this->meta_title,
            'meta_description' =>$this->meta_description,
            'meta_keywords' =>$this->meta_keywords,
            'rating' => $this->whenLoaded('rating'),
            'Review' => $this->whenLoaded('review'),
            // 'Reviews' => $this->rating

            // 'rating_number' => $this->whenLoaded('rating')?$this->rating->count():null,
            // 'rating_avg' => $this->whenLoaded('rating')?$this->rating->sum('stars_rated')/$this->rating->count():null,

        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storedProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=> ["string",'required'],
            'small_description'=>["string","nullable"],
            'description'=>["string","nullable"],
            'price'=>["numeric","required"],
            'photo'=>["image","required"],
            'color'=>["string"],
            'size'=>["string"],
            'tax'=>["numeric","required"],
            'quantity'=>["numeric","required"],
            'status'=> ["required","in:active,inactive"],
            'category_id'=>["required","exists:categories,id"],
            'child_category_id'=>["nullable","exists:categories,id"],
            'supplier_id'=>["nullable","exists:suppliers,id"],
            'brand_id'=>["nullable","exists:brands,id"],
            'discount_id'=>['nullable',"exists:discounts,id"],
            'location_id'=>['required',"exists:locations,id"],


        ];
    }
}

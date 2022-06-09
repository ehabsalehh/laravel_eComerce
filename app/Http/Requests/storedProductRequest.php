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
            'slug'=>["string",'required'],
            'small_description'=>["string","nullable"],
            'description'=>["string","nullable"],
            'original_price'=>["numeric","required"],
            'selling_price'=>["numeric","required"],
            'photo'=>["image","required"],
            'quantity'=>["numeric","required"],
            'tax'=>["numeric","required"],
            'popular'=>["required","in:popular,unpopular"],
            'status'=> ["required","in:active,inactive"],
            'meta_title'=>["string","nullable"],
            'meta_description'=>["string","nullable"],
            'meta_keywords'=>["string","nullable"],
            'category_id'=>["required","exists:categories,id"]

        ];
    }
}

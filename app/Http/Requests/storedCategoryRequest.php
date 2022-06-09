<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storedCategoryRequest extends FormRequest
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
        'description'=>["string","required"],
        'photo'=>["image","nullable"],
        'popular'=>["required","in:popular,unpopular"],
        'status'=> ["required","in:active,inactive"],
        'meta_title'=>["string","required"],
        'meta_description'=>["string","required"],
        'meta_keywords'=>["string","required"]
        ];
    }
}

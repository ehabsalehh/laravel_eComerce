<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storedCategoryRequest extends FormRequest
{
    /**
     * Determine if the Customer is authorized to make this request.
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
        'description'=>["string","required"],
        'photo'=>["image","nullable"],
        'status'=> ["required","in:active,inactive"],
        'is_parent'=>['sometimes','in:1'],
        'parent_id'=>['nullable','exists:categories,id','required_unless:is_parent,1'],
        ];
    }
}

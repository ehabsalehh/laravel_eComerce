<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;
use App\Enums\Employee\Product\CategoryStatus;

class storedCategoryRequest extends FormRequest
{
   

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
        'images'=>["image","nullable"],
        'status'=> ["required",new Enum(CategoryStatus::class)],
        'is_parent'=>['sometimes','in:1'],
        'parent_id'=>['nullable','exists:categories,id','required_unless:is_parent,1'],
        ];
    }
}

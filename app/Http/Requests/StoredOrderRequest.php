<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoredOrderRequest extends FormRequest
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
            'first_name'=>['required','string'],
            'last_name'=>['required','string'],
            'email'=>['required','email'],
            'country'=>['required','string'],
            'phone'=>['required','numeric'],
            'city'=>['required','string'],
            'post_code'=>['nullable','string'],
            'address1'=>['required','string'],
            'address2'=>['nullable','string'],
            'customer_id'=>['exists:customers,id'],
        ];
    }
}

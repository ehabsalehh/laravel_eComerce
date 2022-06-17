<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storedRatingRequest extends FormRequest
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
            'product_id'=>["required","exists:products,id"],
            'customer_id'=>["exists:customers,id"],
            'stars_rated' =>['required','numeric'],


        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoredReviewRequest extends FormRequest
{
    /**
     * Determine if the customer is authorized to make this request.
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
            'customer_review' => ['required','string']

        ];
    }
}

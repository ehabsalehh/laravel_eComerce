<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
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
            'name' => ['string','required'],
            'contact_name' => ['string','required'],
            'address' => ['string','required'],
            'city' => ['string','required'],
            'country' => ['string','required'],
            'phone' => ['string','required','digits:11'],
            'postal_code' => ['string','nullable'],
        ];
    }
}

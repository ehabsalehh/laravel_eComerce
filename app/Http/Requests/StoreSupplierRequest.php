<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
{
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

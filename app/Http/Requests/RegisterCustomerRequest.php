<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterCustomerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' =>['string','required','unique:customers,email'],
            'password' => ['required','confirmed',Password::min(8)->mixedCase()],
            'first_name' => ['string','required'],
            'last_name' => ['string','required'],
            'phone' => ['string','required','digits:11'],
            'country' => ['string','required'],
            'city' => ['string','required'],
            'postal_code' => ['string','nullable'],
            'address1' => ['string','required'],
            'address2' => ['string','nullable'],
            'shipper_address' => ['string','required'],
            'shipper_city' => ['string','required'],
            'billing_address' => ['string','required'],
            'billing_city' => ['string','required'],
        ];
    }
}

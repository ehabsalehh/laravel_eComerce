<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerProfileRequest extends FormRequest
{
   
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => [
                'required',
                Rule::unique('customers')->ignore(auth()->user()->id),
            ],
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

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterCustomerRequest extends FormRequest
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
            'email' =>['string','required','unique:customers,email'],
            'password' => ['string','required','min:6','confirmed'],
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

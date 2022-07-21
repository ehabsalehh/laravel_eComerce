<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class ReqisterAdminRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' =>['string','required','unique:admins,email'],
            'password' => ['required','confirmed',Password::min(8)->mixedCase()],
            'first_name' => ['string','required'],
            'last_name' => ['string','required'],
            'Birth_date' => ['date','required'],
            'avatar' => ['image','required'],
            'note' => ['string','required'],
        ];
    }
}

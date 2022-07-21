<?php

namespace App\Http\Requests;

use App\Rules\MatchOldPassword;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required',Password::min(8)->mixedCase()],
            'password_confirmation' => ['same:new_password'],
        ];
    }
}

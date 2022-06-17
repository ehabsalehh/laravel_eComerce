<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReqisterEmployeeRequest extends FormRequest
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
            'email' =>['string','required','unique:Employees,email'],
            'password' => ['string','required','min:6','confirmed'],
            'first_name' => ['string','required'],
            'last_name' => ['string','required'],
            'Birth_date' => ['date','required'],
            'photo' => ['image','required'],
            'note' => ['string','required'],

        ];
    }
}

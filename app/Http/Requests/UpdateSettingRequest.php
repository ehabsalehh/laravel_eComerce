<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
{
   
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [            
                'description'=>['required','string'],
                'logo'=>['required'],
                'address'=>['required','string'],
                'email'=>['required','email'],
                'phone'=>['required','string'],
        ];
    }
}

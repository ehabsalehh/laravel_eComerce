<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoredOrderRequest extends FormRequest
{
    /**
     * Determine if the Customer is authorized to make this request.
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
            'status' =>["required","in:new,process,delivered,cancel"],
            'shipping_id'=>['exists:shippings,id'],
            'employee_id'=>['exists:employees,id'],
            'customer_id'=>['exists:customers,id'],

        ];
    }
}

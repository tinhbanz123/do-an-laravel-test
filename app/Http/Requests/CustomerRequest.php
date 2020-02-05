<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'first' => 'required|max:20,first_name' . $this->id,
            'last' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric|min:10,phone,' . $this->id,
            'email' => 'required|unique:customers,email,'. $this->id,
            'pass' => 'required|min:6|max:10'
        ];
    }
}

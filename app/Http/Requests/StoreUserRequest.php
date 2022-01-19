<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email:rfc,dns'],
            'phone' => ['required', 'numeric'],
            'address' => ['nullable'],
            'gender' => ['required', 'in:MALE,FEMALE'],
            'avatar' => ['required', 'file', 'mimes:jpg,jpeg,png', 'max:1024'],
        ];
    }
}

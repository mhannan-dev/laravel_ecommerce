<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class UserRegRequest extends FormRequest
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
            'title' => 'required',
            'email' => 'required|email|unique:users',
            'mobile' => 'required',
            'password' => 'required'
        ];
    }
    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Please enter category name!',
            'email.required' => 'Email is required',
            'mobile.required' => 'Mobile no is required',
            'password.required' => 'Password is required'
        ];
    }
}

<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class ContactReq extends FormRequest
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
			'name' => 'required',
			'email' => 'required',
			'subject' => 'required',
			'user_message' => 'required'
		];
	}
	/**
	 * Get the error messages for the defined validation rules.
	 *
	 * @return array
	 */
	public function messages()
	{
		return [
			'name.required' => 'The name field can not be blank',
			'email.email' => 'The country field can not be blank',
			'subject' => 'The division field can not be blank',
			'user_message.required' => 'The district field can not be blank'
		];
	}
}

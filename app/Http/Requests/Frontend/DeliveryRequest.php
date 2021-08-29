<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryRequest extends FormRequest
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
            'country' => 'required',
            'division'=> 'required',
            'district'=> 'required',
            'police_station'=> 'required',
            'mobile'=> 'required|numeric',
            'area'=> 'required',
            'address'=> 'required',
            'zip_code'=> 'required'

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
            'country.required' => 'The country field can not be blank',
            'division.required'=> 'The division field can not be blank',
            'district.required'=> 'The district field can not be blank',
            'police_station.required'=> 'The police station field can not be blank',
            'mobile.required'=> 'required|numeric',
            'area.required'=> 'The area field can not be blank',
            'address.required'=> 'The address field can not be blank',
            'zip_code.required'=> 'required|numeric'
        ];
    }
}

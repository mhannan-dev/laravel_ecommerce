<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;
class CouponRequest extends FormRequest
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
            'coupon_option' => 'required',
            //'coupon_code' => 'required',
            'categories' => 'required',
            'users'=> 'required',
            'coupon_type'=> 'required',
            'amount_type'=> 'required',
            'amount'=> 'required|numeric',
            'expiry_date'=> 'required',
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
            'coupon_option.required' => 'The coupon_option field can not be blank value',
            //'coupon_code.required' => 'The coupon_code field can not be blank value',
            'categories.required' => 'The category field can not be blank value',
            'users.required' => 'The users field can not be blank value',
            'coupon_type.required' => 'The coupon type field can not be blank value',
            'amount_type.required' => 'The amount type field can not be blank value',
            'amount.required' => 'The amount field can not be blank value',
            'expiry_date.required' => 'The expiry date field can not be blank value'
        ];
    }
}

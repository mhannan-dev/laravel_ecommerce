<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class ProfileUpdateRequest extends FormRequest
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
      $rules = [
        'name' => 'required|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
        'mobile' => 'required|numeric',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'

      ];
      return $rules;
    }
    /**
     * Validation message
     *
     */
    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'mobile.required' => 'Mobile is required',
            'image.required' => 'Image is required'
        ];
    }
}

<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            "title" => 'required|string|max:200',
            "section_id" => "required",
            "parent_id" => "required",
            "discount_amt" => "required",
            "meta_title" => "required",
            "description" => "required",
            "meta_description" => "required",
            "image" => "image|mimes:jpeg,png,jpg,gif,svg|max:2048"
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
            'title.required' => 'Name is required',
            'section_id.required' => 'Section is required',
            'parent_id.required' => 'Parent is required',
            'discount_amt.required' => 'Discount is required',
            'meta_title.required' => 'Meta title required',
            'description.required' => 'Description is required',
            'meta_description.required' => 'Meta description is required',
            'image.required' => 'Image is required',
        ];
    }
}

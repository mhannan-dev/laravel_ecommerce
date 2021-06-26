<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;
class ProductRequest extends FormRequest
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
    public function rules()
    {
        return [
            "title" => 'required|string|max:200',
            "brand_id" => "required",
            "category_id" => "required",
            "code" => "required",
            "color" => "required",
            "price" => "required",
            "weight" => "required",
            "discount_amt" => "required",
            "image" => "required",
            "description" => "required",
            "wash_care" => "required",
            "fabric" => "required",
            "pattern" => "required",
            "sleeve" => "required",
            "fit" => "required",
            "occasion" => "required",
            "meta_title" => "required",
            "meta_description" => "required",
            "meta_keyword" => "required",
            "status" => "required"
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
            "title" => "Name Is required",
            "brand_id" => "Brand is required",
            "category_id" => "Category Is required",
            "color" => "Color Is required",
            "code" => "Code Is required",
            "price"=> "Price Is required",
            "weight"=> "Weight Is required",
            "discount_amt"=> "Discount Is required",
            "image"=> "Image Is required",
            "description"=> "Description Is required",
            "wash_care"=> "Wash care Is required",
            "fabric"=> "Fabric Is required",
            "pattern"=> "Pattern Is required",
            "sleeve"=> "Sleeve Is required",
            "fit"=> "Fit Is required",
            "occasion"=> "Occasion Is required",
            "meta_title"=> "Meta title Is required",
            "meta_description"=> "Meta description Is required",
            "meta_keyword"=> "Meta keyword Is required",
            "status"=> "Status Is required",
        ];
    }
}

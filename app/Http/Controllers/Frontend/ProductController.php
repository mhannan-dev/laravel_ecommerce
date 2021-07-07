<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PHPUnit\Framework\ComparisonMethodDoesNotDeclareBoolReturnTypeException;

class ProductController extends Controller
{
    public function listing($slug)
    {
        $data['title'] = "Listing";
        $categoryCount = Category::where(['slug' => $slug, 'status' => 1])->count();
        if ($categoryCount > 0) {
            $categoryDetails = Category::catDetails($slug);
            // echo '<pre>'; print_r($categoryDetails);die;
            $categoryProducts = Product::whereIn('category_id', $categoryDetails['catIds'])->where('status', 1)->get()->toArray();

            return view('frontend.pages.products.listing', compact(['categoryDetails', 'categoryProducts']));
        } else {
            abort(404);
        }
    }
}

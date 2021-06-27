<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PHPUnit\Framework\ComparisonMethodDoesNotDeclareBoolReturnTypeException;

class ProductController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function listing($url)
    {

        $data['title'] = "Listing";
        $categoryCount = Category::where(['slug' => $url, 'status' => 1])->count();
        if ($categoryCount > 0) {
            $categoryDetails = Category::catDetails($url);
            // echo '<pre>'; print_r($categoryDetails);die;
            $categoryProducts = Product::whereIn('category_id', $categoryDetails['catIds'])->where('status', 1)->get()->toArray();

            return view('frontend.pages.products.listing', compact(['categoryDetails', 'categoryProducts']));
        } else {
            abort(404);
        }
    }
}

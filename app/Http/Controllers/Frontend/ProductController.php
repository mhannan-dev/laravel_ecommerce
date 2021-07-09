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
            $categoryProducts = Product::with('brand')->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1)->get()->toArray();

            // $categoryProducts = Product::with('brand')->whereIn('category_id', array($categoryDetails['catIds']))->where('status', 1)->get()->toArray();
            //echo "<pre>"; print_r($categoryProducts); exit;
            return view('frontend.pages.products.listing')->with(compact('categoryDetails','categoryProducts'));
        } else {
            abort(404);
        }
    }
}

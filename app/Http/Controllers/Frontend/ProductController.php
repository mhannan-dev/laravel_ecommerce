<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
            $categoryDetails = Category::categoryDetails($url);
        } else {
            abort(404);
        }
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PHPUnit\Framework\ComparisonMethodDoesNotDeclareBoolReturnTypeException;

class ProductController extends Controller
{
    public function listing($slug, Request $request)
    {

        if ($request->ajax()) {
            $data = $request->all();
            echo "<pre>";
            print_r($data);
            die;
        } else {
            $categoryCount = Category::where(['slug' => $slug, 'status' => 1])->count();
            if ($categoryCount > 0) {
                $categoryDetails = Category::catDetails($slug);
                $categoryProducts = Product::with('brand')->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);
                //echo "<pre>"; print_r($categoryProducts); exit;
                if (isset($_GET['sort_products']) && !empty($_GET['sort_products'])) {
                    if ($_GET['sort_products'] == "latest_product") {
                        $categoryProducts->orderBy('id', 'DESC');
                    } else if ($_GET['sort_products'] == "products_sort_a_to_z") {
                        $categoryProducts->orderBy('title', 'ASC');
                    } else if ($_GET['sort_products'] == "products_sort_z_to_a") {
                        $categoryProducts->orderBy('title', 'DESC');
                    } else if ($_GET['sort_products'] == "lowest_price_wise_products") {
                        $categoryProducts->orderBy('price', 'ASC');
                    } else if ($_GET['sort_products'] == "highest_price_wise_products") {
                        $categoryProducts->orderBy('price', 'DESC');
                    }
                } else {
                    $categoryProducts->orderBy('id', 'DESC');
                }
                //After doing filter work this paginate
                $categoryProducts = $categoryProducts->paginate(6);
                $title = "Listing";
                return view('frontend.pages.products.listing')->with(compact('categoryDetails', 'categoryProducts', 'slug', 'title'));
            } else {
                abort(404);
            }
        }
    }
}

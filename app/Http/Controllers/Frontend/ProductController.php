<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\ComparisonMethodDoesNotDeclareBoolReturnTypeException;

class ProductController extends Controller
{
    public function listing(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            //echo"<pre>"; print_r($data); die;
            $slug = $data['url'];
            $categoryCount = Category::where(['slug' => $slug, 'status' => 1])->count();
            if ($categoryCount > 0) {
                $categoryDetails = Category::catDetails($slug);
                $categoryProducts = Product::with('brand')->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);
                //echo "<pre>"; print_r($categoryProducts); exit;
                //If product fabric is selected
                if (isset($data['fabric']) && !empty($data['fabric'])) {
                    $categoryProducts->whereIn('products.fabric', $data['fabric']);
                }
                //If product Sleeve is selected
                if (isset($data['sleeve']) && !empty($data['sleeve'])) {
                    $categoryProducts->whereIn('products.sleeve', $data['sleeve']);
                }

                //If product pattern is selected
                if (isset($data['pattern']) && !empty($data['pattern'])) {
                    $categoryProducts->whereIn('products.pattern', $data['pattern']);
                }
                //If product occasion is selected
                if (isset($data['occasion']) && !empty($data['occasion'])) {
                    $categoryProducts->whereIn('products.occasion', $data['occasion']);
                }
                //If product fit is selected
                if (isset($data['fit']) && !empty($data['fit'])) {
                    $categoryProducts->whereIn('products.fit', $data['fit']);
                }
                //If product sort is selected
                if (isset($data['sort']) && !empty($data['sort'])) {
                    if ($data['sort'] == "latest_product") {
                        $categoryProducts->orderBy('id', 'DESC');
                    } else if ($data['sort'] == "products_sort_a_to_z") {
                        $categoryProducts->orderBy('title', 'ASC');
                    } else if ($data['sort'] == "products_sort_z_to_a") {
                        $categoryProducts->orderBy('title', 'DESC');
                    } else if ($data['sort'] == "lowest_price_wise_products") {
                        $categoryProducts->orderBy('price', 'ASC');
                    } else if ($data['sort'] == "highest_price_wise_products") {
                        $categoryProducts->orderBy('price', 'DESC');
                    }
                } else {
                    $categoryProducts->orderBy('id', 'DESC');
                }
                //After doing filter work this paginate
                $categoryProducts = $categoryProducts->paginate(6);
                $title = "Listing";
                return view('frontend.pages.products.ajax_prd_listing')->with(compact('categoryDetails', 'categoryProducts', 'slug', 'title'));
            } else {
                abort(404);
            }
        } else {
            $slug = Route::getFacadeRoot()->current()->uri();
            $categoryCount = Category::where(['slug' => $slug, 'status' => 1])->count();
            if ($categoryCount > 0) {
                $categoryDetails = Category::catDetails($slug);
                $categoryProducts = Product::with('brand')->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);
                //echo "<pre>"; print_r($categoryProducts); exit;
                $categoryProducts = $categoryProducts->paginate(6);
                $title = "Listing";
                $page_name = "listing";
                $product_filters = Product::product_filters();
                $fabrics = $product_filters['fabrics'];
                $sleeves = $product_filters['sleeves'];
                $patterns = $product_filters['patterns'];
                $occasions = $product_filters['occasions'];
                $fits = $product_filters['fits'];
                return view('frontend.pages.products.listing')->with(compact('categoryDetails', 'categoryProducts', 'slug', 'title', 'page_name', 'fabrics', 'sleeves', 'patterns', 'occasions', 'fits'));
            } else {
                abort(404);
            }
        }
    }
}

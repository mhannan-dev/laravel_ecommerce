<?php
namespace App\Http\Controllers\Frontend;
use App\Models\Product;
use App\Http\Controllers\Controller;
class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['page_file_name'] = "index";
        $data['page_title'] = "Home";
        $data['feature_product_count'] = Product::where('is_featured', 'Yes')->count();
        $feature_products = Product::where('is_featured', 'Yes')->get()->toArray();
        $data['feature_product_chunk'] = array_chunk($feature_products, 4);
        $data['new_products'] = Product::orderBy('id', 'DESC')->where('status', 1)->limit(8)->get()->toArray();
        //dd($data['new_products']);
        return view('frontend.pages.index', $data);
    }
}
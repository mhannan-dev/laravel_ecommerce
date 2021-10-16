<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
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
		$feature_products = Product::select('id', 'title', 'price', 'image')->where('is_featured', 'Yes')->get()->toArray();
		$data['feature_product_chunk'] = array_chunk($feature_products, 4);
		//dd($feature_products);
		$data['new_products'] = Product::orderBy('id', 'DESC')->where('status', 1)->limit(8)->get()->toArray();
		$data['seo_data'] = DB::table('seo_settings')->select('meta_title', 'meta_tags', 'meta_description')->get();
		//dd($data['seo_data']);
		return view('frontend.pages.index', $data);
	}
}

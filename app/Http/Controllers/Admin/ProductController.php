<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Section;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductsImage;
use App\Models\ProductAttribute;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Admin\ProductRequest;

class ProductController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function products()
	{
		Session::put('page', 'products');
		$data['title'] = "Product";
		$data['products'] = Product::with([
			'section' => function ($query) {
				$query->select('id', 'title');
			}, 'category' => function ($query) {
				$query->select('id', 'title');
			}
		])->orderBy('id', 'DESC')->get();
		//dd($data['products']);
		return view('admin.pages.product.products', $data);
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$data['title'] = "Product";
		$data['product_data'] = new Product();
		$product_filters = Product::product_filters();
		//echo "<pre>"; print_r($product_filters);die;echo "</pre>";
		$data['fabrics'] = $product_filters['fabrics'];
		$data['sleeves'] = $product_filters['sleeves'];
		$data['patterns'] = $product_filters['patterns'];
		$data['occasions'] = $product_filters['occasions'];
		$data['fits'] = $product_filters['fits'];
		$categories = Section::with('categories')->get();
		$data['categories'] = json_decode(json_encode($categories), true);
		$brands = Brand::select('id', 'title')->where('status', 1)->get();
		$data['brands'] = json_decode(json_encode($brands), true);
		//dd($data['brands']);
		return view('admin.pages.product.add', $data);
	}
	/**
	 * Update product status onclick
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update_product_status(Request $request)
	{
		if ($request->ajax()) {
			$data = $request->all();
			if ($data['status'] == "Active") {
				$status = 0;
			} else {
				$status = 1;
			}
			Product::where('id', $data['product_id'])->update(['status' => $status]);
			return  response()->json(['status' => $status, 'product_id' => $data['product_id']]);
		}
	}
	/**
	 * Update product status onclick
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update_attribute_status(Request $request)
	{
		if ($request->ajax()) {
			$data = $request->all();
			if ($data['status'] == "Active") {
				$status = 0;
			} else {
				$status = 1;
			}
			ProductAttribute::where('id', $data['attribute_id'])->update(['status' => $status]);
			return  response()->json(['status' => $status, 'attribute_id' => $data['attribute_id']]);
		}
	}
	//Update_img_status
	public function update_img_status(Request $request)
	{
		if ($request->ajax()) {
			$data = $request->all();
			if ($data['status'] == "Active") {
				$status = 0;
			} else {
				$status = 1;
			}
			ProductsImage::where('id', $data['prd_image_id'])->update(['status' => $status]);
			return  response()->json(['status' => $status, 'prd_image_id' => $data['prd_image_id']]);
		}
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(ProductRequest $request, Product $product)
	{
		try {
			if ($request->hasfile('image')) {
				$image = $request->file('image');
				if ($image->isValid()) {
					$imageName  = time() . '.' . $image->getClientOriginalExtension();
					$large_image_path = 'uploads/product_img_large/' . $imageName;
					$medium_image_path = 'uploads/product_img_medium/' . $imageName;
					$small_image_path = 'uploads/product_img_small/' . $imageName;
					Image::make($image)->resize(1040, 1200)->save($large_image_path);
					Image::make($image)->resize(375, 500)->save($medium_image_path);
					Image::make($image)->resize(260, 300)->save($small_image_path);
				}
			}
			$productFillable         = $request->only($product->getFillable());
			$categoryDetail = Category::find($request->category_id);
			$productFillable['section_id'] = $categoryDetail['section_id'];
			$productFillable['image']  = $imageName;
			$product->fill($productFillable)->save();
			return redirect()->route('sadmin.products')->with('success', 'Product has been saved successfully!!');
		} catch (\Throwable $th) {
			//dd($th);
			return redirect()->back()->with('error', 'Product not saved successfully!!');
		}
	}
	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function show(Product $product)
	{
		//
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$title = "Update";
		$product_data = Product::find($id);
		$product_data = json_decode(json_encode($product_data), true);
		$product_filters = Product::product_filters();
		$fabrics = $product_filters['fabrics'];
		$sleeves = $product_filters['sleeves'];
		$patterns = $product_filters['patterns'];
		$occasions = $product_filters['occasions'];
		$fits = $product_filters['fits'];
		$categories = Section::with('categories')->select('id', 'title')->get();
		$categories = json_decode(json_encode($categories), true);
		$brands = Brand::select('id', 'title')->where('status', 1)->get();
		$data['brands'] = json_decode(json_encode($brands), true);
		return view('admin.pages.product.edit')->with(compact('brands', 'product_data', 'fabrics', 'sleeves', 'patterns', 'patterns', 'occasions', 'fits', 'categories', 'title'));
	}
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Product $product)
	{
		//dd($request->all());
		try {
			if ($request->hasfile('image')) {
				// get previous image from folder
				$img_large = public_path("uploads/product_img_large/{$product->image}");
				$img_medium = public_path("uploads/product_img_medium/{$product->image}");
				$img_small = public_path("uploads/product_img_small/{$product->image}");
				if (File::exists($img_large) && File::exists($img_medium) && File::exists($img_small)) {
					// unlink or remove previous image from folder
					unlink($img_large);
					unlink($img_medium);
					unlink($img_small);
				}
				$image = $request->file('image');
				if ($image->isValid()) {
					$imageName  = time() . '.' . $image->getClientOriginalExtension();
					$large_image_path = 'uploads/product_img_large/' . $imageName;
					$medium_image_path = 'uploads/product_img_medium/' . $imageName;
					$small_image_path = 'uploads/product_img_small/' . $imageName;
					Image::make($image)->resize(1040, 1200)->save($large_image_path);
					Image::make($image)->resize(520, 600)->save($medium_image_path);
					Image::make($image)->resize(260, 300)->save($small_image_path);
				}
			} else {
				//If someone update without changing image
				$imageName = $product->image;
			}
			$productFillable           = $request->only($product->getFillable());
			$categoryDetail = Category::find($request->category_id);
			$productFillable['section_id'] = $categoryDetail['section_id'];
			$productFillable['image']  = $imageName;
			$product->fill($productFillable)->save();
			return redirect()->route('sadmin.products')->with('success', 'Product has been updated successfully!!');
		} catch (\Throwable $th) {
			//dd($th);
			return redirect()->back()->with('error', 'Product not updated successfully!!');
		}
	}
	/**
	 * Remove the specified resource from storage.
	 * @param  \App\Models\Product  $product
	 * @return \Illuminate\Http\Response
	 * ProductAttribute Delete
	 */
	public function delete_attribute($id)
	{
		try {
			ProductAttribute::where('id', $id)->firstorfail()->delete();
			return redirect()->back()->with('success', 'Your product attribute has been deleted!!');
		} catch (\Throwable $th) {
			return redirect()->back()->with('error', 'Your product attribute not been deleted!!');
		}
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		try {
			$product = Product::findOrFail($id);
			$large_image_path = public_path() . '/uploads/product_img_large/' . $product->image;
			$medium_image_path =  public_path() . '/uploads/product_img_medium/' . $product->image;
			$small_image_path =  public_path() . '/uploads/product_img_small/' . $product->image;
			if (!is_null($product)) {
				$product->delete();
				unlink($large_image_path);
				unlink($medium_image_path);
				unlink($small_image_path);
				return redirect()->route('sadmin.products')->with('Your product has been deleted!!');
			} else{
                $product->delete();
            }
		} catch (\Throwable $th) {
			//dd($th);
			return redirect()->back('sadmin.products')->with('success', 'Your product not deleted!!');
		}
	}
	public function deleteImage($id)
	{
		try {
			$productImage = ProductsImage::select('images')->where('id', $id)->first();
			//dd($productImag);
			$large_image_path  = public_path() . '/uploads/product_img_large/';
			$medium_image_path  = public_path() . '/uploads/product_img_medium/';
			$small_image_path  = public_path() . '/uploads/product_img_small/';
			//Delete large image if exist in large folder
			if (file_exists($large_image_path . $productImage->images)) {
				unlink($large_image_path . $productImage->images);
			}
			//Delete large image if exist in medium folder
			if (file_exists($medium_image_path . $productImage->images)) {
				unlink($medium_image_path . $productImage->images);
			}
			//Delete large image if exist in small folder
			if (file_exists($small_image_path . $productImage->images)) {
				unlink($small_image_path . $productImage->images);
			}
			ProductsImage::where('id', $id)->delete();
			return redirect()->back('sadmin.categories')->with('Your product image has been deleted!!');
		} catch (\Throwable $th) {
			// dd($th);
			return redirect()->back('sadmin.categories')->with('Your product not deleted!!');
		}
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function add_attributes(Request $request, $id)
	{
		if ($request->isMethod('post')) {
			$data = $request->all();
			// echo "<pre>"; print_r($data);die;
			foreach ($request->sku as $key => $value) {
				if (!empty($value)) {
					//SKU exist check
					$attrCountSku = ProductAttribute::where('sku', $value)->count();
					if ($attrCountSku > 0) {
						toast('SKU already exist please try another SKU', 'error', 'top-right');
						return redirect()->back();
					}
					//Size exist check
					$attrCountSize = ProductAttribute::where(['product_id' => $id, 'size' => $request->size[$key]])->count();
					if ($attrCountSize > 0) {
						return redirect()->back()->with('error', 'Size already exist please try another');
					}
					$data = array(
						'product_id' => $id,
						'size' => $request->size[$key],
						'sku' => $value,
						'price' => $request->price[$key],
						'stock' => $request->stock[$key]
					);
					ProductAttribute::insert($data);
				}
			};
			return redirect()->back()->with('success', 'Product attribute has been saved');
		}
		$title = "Product Attributes";
		$product =  Product::select('id', 'title', 'code', 'color', 'image', 'price')->with('attributes')->find($id);
		$product = json_decode(json_encode($product),  true);
		//echo "<pre>"; print_r($product); die;
		return view('admin.pages.product.attribute')->with(compact('product', 'title'));
	}
	public function update_attributes(Request $request)
	{
		if ($request->isMethod('post')) {
			$data = $request->all();

			foreach ($data['attrId'] as $key => $value) {
				if (!empty($value)) {
					ProductAttribute::where(
						[
							'id' => $data['attrId'][$key]
						]
					)->update(
						[
							'price' => $data['price'][$key],
							'stock' => $data['stock'][$key],
						]
					);
				}
			}
			return redirect()->back()->with('success', 'Attribute has been updated!');
		}
	}
	public function add_images(Request $request, $id)
	{
		$title = "Images";
		$product_data =  Product::with('images')->select('id', 'title', 'code', 'color', 'image')
			->find($id);
		$product_data = json_decode(json_encode($product_data),  true);
		if ($request->isMethod('post')) {
			if ($request->hasFile('images')) {
				$images = $request->file('images');
				foreach ($images as $key => $image) {
					$product_image = new ProductsImage();
					$image_tmp = Image::make($image);
					$imageName  = time() . '.' . $image->getClientOriginalExtension();
					$large_image_path = 'uploads/product_img_large/' . $imageName;
					$medium_image_path = 'uploads/product_img_medium/' . $imageName;
					$small_image_path = 'uploads/product_img_small/' . $imageName;
					Image::make($image_tmp)->resize(1040, 1200)->save($large_image_path);
					Image::make($image_tmp)->resize(520, 600)->save($medium_image_path);
					Image::make($image_tmp)->resize(260, 300)->save($small_image_path);
					$product_image->images = $imageName;
					$product_image->product_id = $id;
					$product_image->save();
				}
				return redirect()->back()->with('Product Images been saved successfully', 'success');
			}
		}
		return view('admin.pages.product.add_images', compact('product_data', 'title'));
	}
}

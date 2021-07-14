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
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = "Product";
        $data['products'] = Product::with([
            'section' => function ($query) {
                $query->select('id', 'title');
            }, 'category' => function ($query) {
                $query->select('id', 'title');
            }
        ])->get();
        //dd($data['products']);
        return view('admin.pages.product.index', $data);
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
    //update_img_status
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
        //dd($request->all());
        try {
            $image = $request->file('image');
            if (isset($image)) {
                $imageName  = time() . '.' . $image->getClientOriginalExtension();
                if (!Storage::disk('public')->exists('product')) {
                    Storage::disk('public')->makeDirectory('product');
                }
                $productImage = Image::make($image)->resize(200, 200)->save(storage_path('product'));
                Storage::disk('public')->put('product/' . $imageName, $productImage);
            } else {
                $imageName = "default.png";
            }
            $productFillable         = $request->only($product->getFillable());
            $categoryDetail = Category::find($request->category_id);
            $productFillable['section_id'] = $categoryDetail['section_id'];
            $productFillable['image']  = $imageName;
            $product->fill($productFillable)->save();
            toast("Product has been saved successfully", 'success', 'top-right');
            return redirect()->route('product.index');
        } catch (\Throwable $th) {
            // dd($th);
            toast("Product not saved successfully", 'warning', 'top-right');
            return redirect()->back();
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
            $image = $request->file('image');
            if (isset($image)) {
                $imageName  = time() . '.' . $image->getClientOriginalExtension();
                if (!Storage::disk('public')->exists('product')) {
                    Storage::disk('public')->makeDirectory('product');
                }
                //Delelte existiing image
                if (Storage::disk('public')->exists('product/' . $product->image)) {
                    Storage::disk('public')->delete('product/' . $product->image);
                }
                //Saving image
                $productImage = Image::make($image)->resize(200, 200)->save(storage_path('product'));
                Storage::disk('public')->put('product/' . $imageName, $productImage);
            } else {
                //If someone update without changing image
                $imageName = $product->image;
            }
            $productFillable           = $request->only($product->getFillable());
            $categoryDetail = Category::find($request->category_id);
            $productFillable['section_id'] = $categoryDetail['section_id'];
            $productFillable['image']  = $imageName;
            $product->fill($productFillable)->save();
            toast("Category has been updated successfully", 'success', 'top-right');
            return redirect()->route('product.index');
        } catch (\Throwable $th) {
            //dd($th);
            toast("Category not updated successfully", 'warning', 'top-right');
            return redirect()->back();
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
            toast('Your product attribute has been deleted.', 'success', 'top-right');
            return redirect()->back();
        } catch (\Throwable $th) {
            toast('Your product attribute not been deleted.', 'warning', 'top-right');
            return redirect()->back();
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
            $image_path  = public_path() . '/storage/product/' . $product->image;
            if (!is_null($product)) {
                $product->delete();
                unlink($image_path);
                toast('Your product has been deleted.', 'success', 'top-right');
                return redirect()->route('product.index');
            }
        } catch (\Throwable $th) {
            toast('Your product not deleted.', 'success', 'top-right');
            return redirect()->back();
        }
    }

    public function delete_product_image($id)
    {
        try {
            $product_image = ProductsImage::findorfail($id);
            $image_path  = public_path() . '/storage/multi_image/' . $product_image->images;
            if (!is_null($product_image)) {
                $product_image->delete();
                unlink($image_path);
                toast('Your product image has been deleted.', 'success', 'top-right');
                return redirect()->back();
            }
        } catch (\Throwable $th) {
           // dd($th);
            toast('Your product not deleted.', 'success', 'top-right');
            return redirect()->back();
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
                // $data = array(
                //     'product_id' => $id,
                //     'size' => $request->size[$key],
                //     'sku' => $v,
                //     'price' => $request->price[$key],
                //     'stock' => $request->stock[$key]
                // );
                // ProductAttribute::insert($data);
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
                        toast('Size already exist please try another', 'error', 'top-right');
                        return redirect()->back();
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
            toast('Product attribute has been saved', 'success', 'top-right');
            return redirect()->back();
        }
        $title = "Product Attributes";
        $product =  Product::select('id', 'title', 'code', 'color', 'image')->with('attributes')->find($id);
        $product = json_decode(json_encode($product),  true);
        //echo "<pre>"; print_r($product); die;
        return view('admin.pages.product.attribute')->with(compact('product', 'title'));
    }
    public function edit_attributes(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            //echo "<pre>";print_r($data);die;
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
            toast('Attribute has been updated', 'success', 'top-right');
            return redirect()->back();
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
                    $imageName = time() . rand(222, 999) . '.' . $image->getClientOriginalExtension();
                    if (!Storage::disk('public')->exists('multi_image')) {
                        Storage::disk('public')->makeDirectory('multi_image');
                    }
                    $multiImage = Image::make($image)->resize(1040, 1200)->save(storage_path('multi_image'));
                    Storage::disk('public')->put('multi_image/' . $imageName, $multiImage);
                    $product_image->images = $imageName;
                    $product_image->product_id = $id;
                    $product_image->save();
                }
                toast("Product Images been saved successfully", 'success', 'top-right');
                return redirect()->back();
            }
        }
        return view('admin.pages.product.add_images', compact('product_data', 'title'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\BrandRequest;
use App\Http\Controllers\Controller;


class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = "Brand";
        $brands = Brand::orderBy('created_at', 'desc')->get();
        $data['brands'] = json_decode(json_encode($brands), true);
        return view('admin.pages.brand.index', $data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update_brand_status(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Brand::where('id', $data['brand_id'])->update(['status' => $status]);
            return  response()->json(['status' => $status, 'brand_id' => $data['brand_id']]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title']      = "New Brand";
        $data['brand']   = new Brand();
        return view("admin.pages.brand.add", $data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request, Brand $brand)
    {
        try {
            $brandFillable        = $request->only($brand->getFillable());
            $brand->fill($brandFillable)->save();
            toast('Brand has been saved!','success','top-right');
            return redirect()->route('brand.index');
        } catch (\Throwable $th) {

            toast('Brand has not been saved!','warning','top-right');
            return redirect()->route('brand.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = "Update";
        $data['brand'] = Brand::find($id);
        if (!is_null($data['brand'])) {
            return view('admin.pages.brand.edit', $data);
        } else {
            return redirect()->route('admin.pages.brand.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        try {
            $brandFillable = $request->only($brand->getFillable());
            $brand->fill($brandFillable)->update();
            toast('Your brand has been updated!','success','top-right');
            return redirect()->route('brand.index');
        } catch (\Throwable $th) {
            toast('Brand has not been updated!','success','top-right');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        try {
            $brand->delete();
            toast('Your brand has been deleted.', 'success', 'top-right');
            return redirect()->back();
        } catch (\Throwable $th) {
            toast('Your brand not deleted.', 'warning', 'top-right');
            return redirect()->back();
        }
    }
}

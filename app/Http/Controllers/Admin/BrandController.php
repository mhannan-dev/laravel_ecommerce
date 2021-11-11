<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Admin\BrandRequest;
use Illuminate\Support\Facades\Validator;


class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function brands()
    {
        Session::put('page', 'brands');
        $data['title'] = "Brand";
        $brands = Brand::orderBy('created_at', 'desc')->get();
        $data['brands'] = json_decode(json_encode($brands), true);
        return view('admin.pages.brand.brands', $data);
    }

    public function addEditBrand(Request $request, $id = null)
    {
        if ($id == "") {
            $title = "New Brand";
            $brandData = new Brand();
            $buttonText = "Save";
            $message = "Brand Created Successfully";
        } else {
            $title = "Update Brand";
            $brandData = Brand::find($id);
            $buttonText = "Update";
            $message = "Brand Updated Successfully";
        }
        if ($request->isMethod('POST')) {
            $data = $request->all();
            //Validation rules
            $rules = [
                'title' => 'required'
            ];
            //Validation message
            $customMessage = [
                'title.required' => 'Brand name  is required'
            ];
            $validator = Validator::make($data, $rules, $customMessage);
            // Check validation failure
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $brandData->title = $data['title'];
            $brandData->status = 1;
            $brandData->save();
            return redirect()->route('sadmin.brands')->with('success', $message);
        }
        return view('admin.pages.brand.addEditBrand', compact('title', 'brandData', 'buttonText', 'message'));
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function deleteBrand($id)
    {
        try {
            $brand = Brand::findOrFail($id);
            if (!is_null($brand)) {
                $brand->delete();
                return response()->json(['success' => 'Your brand has been deleted!!']);
            }
        } catch (\Throwable $th) {
            //dd($th);
            return response()->json(['error' => 'Your brand not deleted!!']);
        }
    }
}

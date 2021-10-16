<?php

namespace App\Http\Controllers\Admin;

use App\Models\SeoSetting;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SeoController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function seoData()
	{
		$data['title'] = "SEO Information";
		//$data['seo_data'] = DB::table('seo_settings')->select('meta_title', 'meta_tags', 'meta_description')->get();
		$data['seo_data'] = DB::table('seo_settings')->select('id','meta_title', 'meta_tags', 'meta_description')->get();
		//dd($data['seo_data']);
		return view('admin.pages.seo.seo_data', $data);
	}

	public function addEditSeoData(Request $request, $id = null)
	{

		if ($id == "") {
			// Add Coupon Code
			$seoData = new SeoSetting();
			$title = "Add SEO Information";
			$buttonText = "Save";
			$message = "Seo Data has been saved successfully!";
			//dd($message);
		} else {
			// Update Coupon Code
			$seoData = SeoSetting::find($id);
			$title = "Edit SeoSetting";
			$buttonText = "Update";
			$message = "SEO Data has been updated successfully!";
		}
		if ($request->isMethod('post')) {
			$data = $request->all();
			//dd($data);
			//Validation rules
			$rules = [
				'meta_title' => 'required',
				'meta_tags' => 'required',
				'meta_description' => 'required'
			];
			//Validation message
			$customMessage = [
				'meta_title.required' => 'Meta title is required',
				'meta_tags.required' => 'Tags is required',
				'meta_description.required' => 'Meta description is required'
			];
			$validator = Validator::make($data, $rules, $customMessage);
			// Check validation failure
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}
			//Saving other field to seo table
			$seoData->meta_title = $data['meta_title'];
			$seoData->meta_tags = $data['meta_tags'];
			$seoData->meta_description = $data['meta_description'];
			$seoData->save();
			return redirect()->route('siteSeo')->with('success', $message);
		}
		return view('admin.pages.seo.addEditSeoData', compact('title', 'buttonText', 'seoData', 'message'));
	}
}

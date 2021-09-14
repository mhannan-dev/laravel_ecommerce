<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ShippingCharge;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function shippingCharges()
    {
        Session::put('page', 'shippingCharges');
        $data['title'] = "Shipping Charges";
        $data['shippingCharges'] = ShippingCharge::latest()->get()->toArray();
        return view('admin.pages.shipping.charges', $data);
    }
    public function editShippingCharge($id, Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            ShippingCharge::where('id', $id)->update([
                'till_500gm' => $data['till_500gm'],
                'till_1000gm' => $data['till_1000gm'],
                'till_2000gm' => $data['till_2000gm'],
                'till_3000gm' => $data['till_3000gm'],
                'till_4000gm' => $data['till_4000gm'],
                'till_5000gm' => $data['till_5000gm'],
            ]);
            return redirect()->route('sadmin.shipping-charges')->with('success', 'Shipping charge updated successfully');
        }
        $data['title'] = "Edit Shipping Charge";
        $data['buttonText'] = "Update";
        $data['charge'] = ShippingCharge::where('id', $id)->first()->toArray();
        return view('admin.pages.shipping.edit_charges', $data);
    }
    public function addEditShippingCharge(Request $request, $id = null)
    {
        if ($id == "") {
            // Add Coupon Code
            $charge = new ShippingCharge();
            $title = "Add Shipping Charge";
            $buttonText = "Save";
            $message = "Shipping charge has been saved successfully!";
        } else {
            // Update charge Code
            $charge = ShippingCharge::findOrFail($id);
            $title = "Edit Shipping Charge";
            $buttonText = "Update";
            $message = "Shipping Charge has been updated successfully!";
        }
        //exit();
        if ($request->isMethod('POST')) {
            $data = $request->all();
            //dd($data);
            $charge->country_name = $data['country_name'];
            $charge->till_500gm = $data['till_500gm'];
            $charge->till_1000gm = $data['till_1000gm'];
            $charge->till_2000gm = $data['till_2000gm'];
            $charge->till_3000gm = $data['till_3000gm'];
            $charge->till_4000gm = $data['till_4000gm'];
            $charge->till_5000gm = $data['till_5000gm'];
            $charge->save();
            return redirect()->route('sadmin.shipping-charges')->with('success', $message);
        }
        return view('admin.pages.shipping.addEditCharge', compact(
            'title',
            'buttonText',
            'charge'
        ));
    }
    public function checkShippingChargeArea(Request $request)
    {
        $data = $request->all();
        //dd($data);
        // if($data['shipping_country_id'] != 0){
        //     $sChargeCount = ShippingCharge::where('id','!=',$data['shipping_country_id'])->where('country', $data['country'])->count();
        // }else{
        // }
        $sChargeCount = ShippingCharge::where('country', $data['country'])->count();
        if ($sChargeCount > 0) {
            return "false";
        } else {
            return "true";
        }
    }
    public function updateShippingChargeStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            ShippingCharge::where('id', $data['shipping_id'])->update(['status' => $status]);
            return  response()->json(['status' => $status, 'shipping_id' => $data['shipping_id']]);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShippingCharge  $shippingCharge
     * @return \Illuminate\Http\Response
     */
    public function edit(ShippingCharge $shippingCharge)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShippingCharge  $shippingCharge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShippingCharge $shippingCharge)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function deleteShippingCharge($id)
    {
        try {
            $shippingCharge = ShippingCharge::findOrFail($id);
            if (!is_null($shippingCharge)) {
                $shippingCharge->delete();
                return redirect()->route('sadmin.shipping-charges')->with('success', 'Shipping-charges has been deleted!!');
            }
        } catch (\Throwable $th) {
            //dd($th);
            return redirect()->back()->with('error', 'Opps shipping charge not deleted');
        }
    }
}

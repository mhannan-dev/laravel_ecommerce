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
        $data['shippingCharges'] = ShippingCharge::get()->toArray();
        return view('admin.pages.shipping.charges', $data);
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
            //Form validation
            $rules = [
                'countries' => 'required|max:255|regex:/^[a-zA-ZÑñ\s]+$/',
                'shipping_charges' => 'required|numeric'
            ];
            $validationMessages = [
                'countries.required' => 'The country field can not be blank',
                'shipping_charges.digits' => 'Shipping charges field can not be blank'
            ];
            $this->validate($request, $rules, $validationMessages);
            $charge->countries = $data['countries'];
            $charge->shipping_charges = $data['shipping_charges'];
            $charge->status = 1;
            $charge->save();
            return redirect()->route('sadmin.shipping-charges')->with('success', $message);
        }
        return view('admin.pages.shipping.addEditCharge', compact(
            'title','buttonText','charge'
        ));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShippingCharge  $shippingCharge
     * @return \Illuminate\Http\Response
     */
    public function show(ShippingCharge $shippingCharge)
    {
        //
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

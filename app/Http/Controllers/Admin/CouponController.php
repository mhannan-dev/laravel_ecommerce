<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Coupon;
use App\Models\Section;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Admin\CouponRequest;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function coupons()
    {
        Session::put('page', 'coupons');
        $data['title'] = "Coupon";
        $data['coupons'] = Coupon::get()->toArray();
        return view('admin.pages.coupons.coupons', $data);
    }
    public function addEditCoupon(Request $request, $id = null)
    {
        if ($id == "") {
            $coupon   = new Coupon;
            // $selCats = array();
            // $selUsers = array();
            $title = "Add Coupon";
            //$message = "Coupon Added Successfully";
            $buttonText = "Save";
        } else {
            $coupon = Coupon::find($id);
            //$selCats = explode(',', $coupon['categories']);
            //$selUsers = explode(',', $coupon['users']);
            $title = "Edit Coupon";
            //$message = "Coupon Updated Successfully";
            $buttonText = "Update";
        }
        if ($request->isMethod('POST')) {
            $data = $request->all();
            //dd($data);
            if ($data['users']) {
                $users = implode(',', $data['users']);
            } else {
                $users = "";
            }
            if ($data['categories']) {
                $categories = implode(',', $data['categories']);
            }
            if ($data['coupon_option'] == "automatic") {
                $coupon_code = Str::random(8);
            } else {
                $coupon_code = $data['coupon_code'];
            }
            try {
                $coupon->coupon_option = $data['coupon_option'];
                $coupon->coupon_type = $data['coupon_type'];
                $coupon->amount_type = $data['amount_type'];
                $coupon->coupon_code = $coupon_code;
                $coupon->amount = $data['amount'];
                $coupon->expiry_date = date('Y-m-d', strtotime($data['expiry_date']));
                $coupon->categories = $categories;
                $coupon->users = $users;
                $coupon->status = 1;
                $coupon->save();
                toast("Coupon has been saved successfully", 'success', 'top-right');
                return redirect()->to('sadmin/coupons');
            } catch (\Throwable $th) {
                //dd($th);
                toast("Coupon not saved successfully", 'warning', 'top-right');
                return redirect()->back();
            }
        }
        $categories = Section::with('categories')->get();
        $categories = json_decode(json_encode($categories), true);
        $users = User::select('email')->where('status', 1)->get()->toArray();
        return view('admin.pages.coupons.addEditCoupon', compact('title', 'coupon', 'categories', 'users', 'buttonText'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title']      = "New Coupon";
        $data['coupon']   = new Coupon();
        $categories = Section::with('categories')->get();
        $data['categories'] = json_decode(json_encode($categories), true);
        $data['users'] = User::select('email')->where('status', 1)->get()->toArray();
        return view("admin.pages.coupons.add", $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Update";
        $coupon = Coupon::find($id);
        $categories = explode(',', $coupon['categories']);
        $users = explode(',', $coupon['users']);
        if (!is_null($coupon)) {
            return view('admin.pages.coupons.edit', compact('coupon', 'categories', 'title'));
        } else {
            return redirect()->to('sadmin/coupons');
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function deleteCoupon($id)
    {
        try {
            $coupon = Coupon::findOrFail($id);
            if (!is_null($coupon)) {
                $coupon->delete();
                toast('Your coupon has been deleted.', 'success', 'top-right');
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            dd($th);
            toast('Your coupon not deleted.', 'success', 'top-right');
            return redirect()->back();
        }
    }
    public function updateCouponStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Coupon::where('id', $data['coupon_id'])->update(['status' => $status]);
            return  response()->json(['status' => $status, 'coupon_id' => $data['coupon_id']]);
        }
    }
}

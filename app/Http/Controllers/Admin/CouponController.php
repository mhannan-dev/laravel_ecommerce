<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Coupon;
use App\Models\Section;
use App\Models\Todo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Admin\CouponRequest;
use App\Models\Admin\Todo as AdminTodo;

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
            // Add Coupon Code
            $coupon = new Coupon;
            $selCats = array();
            $selUsers = array();
            $title = "Add Coupon";
            $buttonText = "Save";
            $message = "Coupon has been saved successfully!";
        } else {
            // Update Coupon Code
            $coupon = Coupon::findOrFail($id);
            $selCats = explode(',', $coupon['categories']);
            $selUsers = explode(',', $coupon['users']);
            $title = "Edit Coupon";
            $buttonText = "Update";
            $message = "Coupon has been updated successfully!";
        }
        //exit();
        if ($request->isMethod('POST')) {
            $data = $request->all();
            //echo '<pre>'; print_r($data); die;
            if (isset($data['users'])) {
                $users = implode(',', $data['users']);
            } else {
                $users = "";
            }
            if (isset($data['categories'])) {
                $categories = implode(',', $data['categories']);
            }
            if ($data['coupon_option'] == "automatic") {
                $coupon_code = Str::random(8);
            } else {
                $coupon_code = $data['coupon_code'];
            }
            $coupon->coupon_option = $data['coupon_option'];
            $coupon->coupon_code = $coupon_code;
            $coupon->categories = $categories;
            $coupon->users = $users;
            $coupon->coupon_type = $data['coupon_type'];
            $coupon->amount_type = $data['amount_type'];
            $coupon->expiry_date = date('Y-m-d', strtotime($data['expiry_date']));
            $coupon->amount = $data['amount'];
            $coupon->status = 1;
            $coupon->save();
            return redirect()->route('sadmin.coupons')->with('success', $message);
        }
        $categories = Section::with('categories')->get();
        $categories = json_decode(json_encode($categories), true);
        $users = User::select('email')->where('status', 1)->get()->toArray();
        return view('admin.pages.coupons.addEditCoupon', compact(
            'title',
            'coupon',
            'categories',
            'users',
            'buttonText',
            'selCats',
            'selUsers'
        ));
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
                return redirect()->route('sadmin.coupons')->with('success', 'Your coupon has been deleted!!');
            }
        } catch (\Throwable $th) {
            //dd($th);
            return redirect()->back()->with('error', 'Opps Your Coupon not deleted');
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

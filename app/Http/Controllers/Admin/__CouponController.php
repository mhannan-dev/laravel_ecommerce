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
use App\Models\Category;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function coupons()
    {
        Session::forget('success_message');
        Session::forget('error_message');
        Session::put('page', 'coupons');
        $data['title'] = "Coupon";
        $data['coupons'] = Coupon::get()->toArray();
        return view('admin.pages.coupons.coupons', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $title = "Create Coupon";
       $categories = Category::get();
       return view('admin.pages.coupons.add', compact('title','categories'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Coupon $coupon)
    {
        if ($request->isMethod('post')) {
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
            $coupon->coupon_type = $data['coupon_type'];
            $coupon->coupon_code = $coupon_code;
            $coupon->categories = $categories;
            $coupon->users = $users;
            $coupon->amount_type = $data['amount_type'];
            $coupon->expiry_date = date('Y-m-d', strtotime($data['expiry_date']));
            $coupon->amount = $data['amount'];
            $coupon->status = 1;
            $coupon->save();
            return redirect()->to('sadmin/coupons')->with('success', 'Coupon saved successfully');
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
            'selUsers',
            'message'
        ));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

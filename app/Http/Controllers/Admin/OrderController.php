<?php

namespace App\Http\Controllers\Admin;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function orders()
    {
        Session::put('page','orders');
        $data['title'] = "Order";
        $data['orders'] = Order::with('order_products')->orderBy('id','DESC')->get()->toArray();
        return view('admin.pages.orders.orders',$data);
    }
    public function orderDetails($id)
    {
        $data['title'] = "Order Details";
        $data['orderDetails'] = Order::with('order_products')->where('id', $id)->first()->toArray();
        //dd($data['orderDetails']);
        return view('admin.pages.orders.order_details',$data);
    }
}

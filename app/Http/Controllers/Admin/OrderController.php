<?php

namespace App\Http\Controllers\Admin;
use App\Models\Order;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function orders()
    {
        $data['title'] = "Order";
        $data['orders'] = Order::get();
        return view('admin.pages.orders.orders',$data);
    }
}

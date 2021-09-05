<?php

namespace App\Http\Controllers\Admin;
use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Models\OrderStatus;
use App\Models\User;
use Illuminate\Http\Request;
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
        $title = "Order Details";
        $orderDetails = Order::with('order_products')->where('id', $id)->first()->toArray();
        $userDetails = User::where('id',$orderDetails['user_id'])->first()->toArray();
        $orderStatuses = OrderStatus::where('status',1)->get()->toArray();
        //dd($data['orderDetails']);
        return view('admin.pages.orders.order_details',compact('orderDetails','userDetails','title','orderStatuses'));
    }
    public function updateOrderStatus(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            Order::where('id',$data['order_id'])->update(['order_status'=>$data['order_status']]);
            return redirect()->back()->with('success','Order status has been updated successfully!!');
        }
    }
}

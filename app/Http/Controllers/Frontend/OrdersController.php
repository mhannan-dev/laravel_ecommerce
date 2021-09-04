<?php
namespace App\Http\Controllers\Frontend;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function orders()
    {
        $data['title'] = "Orders";
        $data['orders'] = Order::with('order_products')->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get()->toArray();
        //dd($data['orders']);
        return view('frontend.pages.user.orders',$data);
    }
}

<?php
namespace App\Http\Controllers\Frontend;
use App\Models\Cart;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class PaypalController extends Controller
{
    public function paypal()
    {
        $title = "Paypal Payment";
        if (Session::has('order_id')) {
            //Delete Logged in user cart
            //Cart::where('user_id', Auth::user()->id)->delete();
            $orderDetails = Order::where('id',Session::get('order_id'))->first()->toArray();
            //dd($orderDetails);
            $nameArr = explode(' ', $orderDetails['name']);
            //Or //$nameArray = mb_str_split($orderDetails['name']);
            //var_dump($nameArr);
            return view('frontend.pages.paypal.paypal',compact('title','orderDetails','nameArr'));
        } else {
            return redirect('cart');
        }
    }
}

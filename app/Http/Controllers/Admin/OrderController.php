<?php

namespace App\Http\Controllers\Admin;

use Dompdf\Dompdf;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderLog;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
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
        Session::put('page', 'orders');
        $data['title'] = "Order";
        $data['orders'] = Order::with('order_products')->orderBy('id', 'DESC')->get()->toArray();
        return view('admin.pages.orders.orders', $data);
    }
    public function orderDetails($id)
    {
        $title = "Order Details";
        $orderDetails = Order::with('order_products')->where('id', $id)->first()->toArray();
        $userDetails = User::where('id', $orderDetails['user_id'])->first()->toArray();
        $orderStatuses = OrderStatus::where('status', 1)->get()->toArray();
        $orderLog = OrderLog::where('order_id', $id)->get()->toArray();
        //dd($data['orderDetails']);
        return view('admin.pages.orders.order_details', compact('orderDetails', 'userDetails', 'title', 'orderStatuses', 'orderLog'));
    }
    public function orderInvoice($id)
    {
        $title = "Invoice";
        $orderDetails = Order::with('order_products')->where('id', $id)->first()->toArray();
        $userDetails = User::where('id', $orderDetails['user_id'])->first()->toArray();
        return view('admin.pages.orders.order_invoice', compact('title', 'orderDetails', 'userDetails'));
    }
    public function orderPdfInvoice($id)
    {
        $title = "Invoice";
        $orderDetails = Order::with('order_products')->where('id', $id)->first()->toArray();
        $userDetails = User::where('id', $orderDetails['user_id'])->first()->toArray();
        $pdf = PDF::loadView('admin.pages.orders.pdf_invoice',compact('title', 'orderDetails', 'userDetails'));
        //Invoice will be download as
        return $pdf->download(date('d-m-Y').'-'.$orderDetails['id'].'-invoice.pdf');

    }
    public function updateOrderStatus(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            Order::where('id', $data['order_id'])->update(['order_status' => $data['order_status']]);
            //Update Order tracking number and courier name
            if (!empty($data['courier_name']) && !empty($data['tracking_number'])) {
                Order::where('id', $data['order_id'])->update(['courier_name' => $data['courier_name'], 'tracking_number' => $data['tracking_number']]);
            }
            //Ddelivery Details
            $deliveryDetails = Order::select('mobile', 'email', 'name')->where('id', $data['order_id'])->first()->toArray();
            $orderDetails = Order::with('order_products')->where('id', $data['order_id'])->first()->toArray();
            //dd($orderDetails);
            //Send order confirmation email to customer
            $email = $deliveryDetails['email'];
            $messageData = [
                'name' => $deliveryDetails['name'],
                'email' => $email,
                'order_id' => $data['order_id'],
                'order_status' => $data['order_status'],
                'courier_name' => $data['courier_name'],
                'tracking_number' => $data['tracking_number'],
                'orderDetails' => $orderDetails,
            ];
            Mail::send(
                'emails.order_status',
                $messageData,
                function ($message) use ($email) {
                    $message->to($email);
                    $message->subject('Order Status Updated - eCommerce');
                }
            );
            //Update order logs
            $order_log = new OrderLog();
            $order_log->order_id = $data['order_id'];
            $order_log->order_status = $data['order_status'];
            $order_log->save();
            return redirect()->back()->with('success', 'Order status has been updated successfully!!');
        }
    }
}

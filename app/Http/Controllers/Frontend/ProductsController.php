<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Country;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Models\DeliveryAddress;
use App\Models\ProductAttribute;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ShippingCharge;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    public function listing(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            $slug = $data['url'];
            $categoryCount = Category::where(['slug' => $slug, 'status' => 1])->count();
            if ($categoryCount > 0) {
                $categoryDetails = Category::catDetails($slug);
                $categoryProducts = Product::with('brand')->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);
                //echo "<pre>"; print_r($categoryProducts); exit;
                //If product fabric is selected
                if (isset($data['fabric']) && !empty($data['fabric'])) {
                    $categoryProducts->whereIn('products.fabric', $data['fabric']);
                }
                //If product Sleeve is selected
                if (isset($data['sleeve']) && !empty($data['sleeve'])) {
                    $categoryProducts->whereIn('products.sleeve', $data['sleeve']);
                }
                //If product pattern is selected
                if (isset($data['pattern']) && !empty($data['pattern'])) {
                    $categoryProducts->whereIn('products.pattern', $data['pattern']);
                }
                //If product occasion is selected
                if (isset($data['occasion']) && !empty($data['occasion'])) {
                    $categoryProducts->whereIn('products.occasion', $data['occasion']);
                }
                //If product fit is selected
                if (isset($data['fit']) && !empty($data['fit'])) {
                    $categoryProducts->whereIn('products.fit', $data['fit']);
                }
                //If product sort is selected
                if (isset($data['sort']) && !empty($data['sort'])) {
                    if ($data['sort'] == "latest_product") {
                        $categoryProducts->orderBy('id', 'DESC');
                    } else if ($data['sort'] == "products_sort_a_to_z") {
                        $categoryProducts->orderBy('title', 'ASC');
                    } else if ($data['sort'] == "products_sort_z_to_a") {
                        $categoryProducts->orderBy('title', 'DESC');
                    } else if ($data['sort'] == "lowest_price_wise_products") {
                        $categoryProducts->orderBy('price', 'ASC');
                    } else if ($data['sort'] == "highest_price_wise_products") {
                        $categoryProducts->orderBy('price', 'DESC');
                    }
                } else {
                    $categoryProducts->orderBy('id', 'DESC');
                }
                //After doing filter work this paginate
                $categoryProducts = $categoryProducts->paginate(6);
                $title = "Listing";
                return view('frontend.pages.products.ajax_prd_listing')->with(compact('categoryDetails', 'categoryProducts', 'slug', 'title'));
            } else {
                abort(404);
            }
        } else {
            $slug = Route::getFacadeRoot()->current()->uri();
            $categoryCount = Category::where(['slug' => $slug, 'status' => 1])->count();
            if ($categoryCount > 0) {
                $categoryDetails = Category::catDetails($slug);
                $categoryProducts = Product::with('brand')->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);
                //echo "<pre>"; print_r($categoryProducts); exit;
                $categoryProducts = $categoryProducts->paginate(6);
                $title = "Listing";
                $page_name = "listing";
                $product_filters = Product::product_filters();
                $fabrics = $product_filters['fabrics'];
                $sleeves = $product_filters['sleeves'];
                $patterns = $product_filters['patterns'];
                $occasions = $product_filters['occasions'];
                $fits = $product_filters['fits'];
                return view('frontend.pages.products.listing')->with(compact('categoryDetails', 'categoryProducts', 'slug', 'title', 'page_name', 'fabrics', 'sleeves', 'patterns', 'occasions', 'fits'));
            } else {
                abort(404);
            }
        }
    }
    public function detail($id)
    {
        Session::forget('error');
        Session::forget('success');
        $product_details = Product::with(['brand', 'category', 'attributes' => function ($query) {
            $query->where('status', 1);
        }, 'images'])->find($id)->toArray();
        $total_stock = ProductAttribute::where('product_id', $id)->sum('stock');
        $related_products = Product::where('category_id', $product_details['category']['id'])->where('id', '!=', $id)->get()->toArray();
        //echo "<pre>";//print_r($related_products);//die;
        return view('frontend.pages.products.detail', compact('product_details', 'total_stock', 'related_products'));
    }
    public function getProductPrice(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $getDiscountedAttrPrice = Product::getDiscountedAttrPrice($data['product_id'], $data['size']);
            return $getDiscountedAttrPrice;
        }
    }
    public function addToCart(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            //Check product stock if product availiable in stock
            $getProductStock = ProductAttribute::where(['product_id' => $data['product_id'], 'size' => $data['size']])->first()->toArray();
            //echo $getProductStock['stock']; die;
            if ($getProductStock['stock'] < $data['quantity']) {
                Session::flash('stock_error_message', 'Required quantity is not availiable');
                return redirect()->back();
            }
            //Generate session ID if not exist
            $session_id = Session::get('session_id');
            if (empty($session_id)) {
                $session_id = Session::getId();
                Session::put('session_id', $session_id);
            }
            //Check product if exist in cart
            if (Auth::check()) {
                $countProduct = Cart::where([
                    'product_id' => $data['product_id'],
                    'size' => $data['size'],
                    'user_id' => Auth::user()->id
                ])->count();
            } else {
                $countProduct = Cart::where([
                    'product_id' => $data['product_id'],
                    'size' => $data['size'],
                    'session_id' => Session::get('session_id')
                ])->count();
            }
            if ($countProduct > 0) {
                Session::flash('product_exist_msg', 'This product is already exist in cart');
                return redirect()->back();
            }
            if (Auth::check()) {
                $user_id = Auth::user()->id;
                //dd($user_id);
            } else {
                $user_id = 0;
            }
            $cart = new Cart;
            $cart->session_id = $session_id;
            $cart->user_id = $user_id;
            $cart->product_id = $data['product_id'];
            $cart->size = $data['size'];
            $cart->quantity = $data['quantity'];
            $cart->save();
            Session::flash('product_added_to_cart_msg', 'Product added to cart');
            return redirect('cart');
        }
    }
    //Cart
    public function cart()
    {
        $userCartItems = Cart::userCartItems();
        //echo "<pre>"; print_r($userCartItems); die;
        return view('frontend.pages.products.cart', compact('userCartItems'));
    }
    // updateCartItemQty using ajax in carts item page
    public function updateCartItemQty(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            //Cart Details
            $cartDetails = Cart::find($data['cart_id']);
            $availableleStock = ProductAttribute::select('stock')->where(['product_id' => $cartDetails['product_id'], 'size' => $cartDetails['size']])->first()->toArray();
            //echo '<pre>';print_r($availiableStock); die;
            //Check stock is available or not
            if ($data['qty'] > $availableleStock['stock']) {
                $userCartItems = Cart::userCartItems();
                return response()->json([
                    'status' => false,
                    'message' => 'Product size is not available',
                    'view' => (string)View::make('frontend.pages.products.cart_items', compact(['userCartItems']))
                ]);
            }
            //Check size is available or not
            $availableleSize = ProductAttribute::where(['product_id' => $cartDetails['product_id'], 'size' => $cartDetails['size'], 'status' => 1])->count();
            if ($availableleSize == 0) {
                $userCartItems = Cart::userCartItems();
                return response()->json([
                    'status' => false,
                    'view' => (string)View::make('frontend.pages.products.cart_items', compact(['userCartItems']))
                ]);
            }
            Cart::where("id", $data['cart_id'])->update(["quantity" => $data['qty']]);
            //Forget coupon session after update cart
            Session::forget('couponCode');
            Session::forget('couponAmount');
            $userCartItems = Cart::userCartItems();
            $totalCartItems  = totalCartItems();
            return response()->json([
                'status' => true,
                'totalCartItems'  => $totalCartItems,
                'view' => (string)View::make('frontend.pages.products.cart_items', compact(['userCartItems']))
            ]);
        }
    }
    public function deleteCartItem(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            Cart::where('id', $data['cart_id'])->delete();
            $userCartItems = Cart::userCartItems();
            $totalCartItems  = totalCartItems();
            return response()->json([
                'totalCartItems'  => $totalCartItems,
                'view' => (string)View::make('frontend.pages.products.cart_items', compact(['userCartItems']))
            ]);
        }
    }
    public function applyCoupon(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $couponCount = Coupon::where('coupon_code', $data['code'])->count();
            if ($couponCount == 0) {
                $userCartItems = Cart::userCartItems();
                $totalCartItems  = totalCartItems();
                return response()->json([
                    'status' => false,
                    'message' => 'Please Enter Valid Coupon!',
                    'totalCartItems' => $totalCartItems,
                    'view' => (string)View::make('frontend.pages.products.cart_items', compact('userCartItems'))
                ]);
            } else {
                #Check other coupon condition
                $couponDetails = Coupon::where('coupon_code', $data['code'])->first();
                //Check coupon is active or not
                if ($couponDetails->status == 0) {
                    $message = "Coupon is not active!";
                }
                //Check coupon is expired
                $expiry_date = $couponDetails->expiry_date;
                $current_date = date('Y-m-d');
                if ($expiry_date < $current_date) {
                    $message = "Opps Coupon is expired!";
                }
                //Check coupon is single or multiple time
                if ($couponDetails['coupon_type'] == "singleTimes") {
                    $couponCopunt = Order::where(['coupon_code' => $data['code'], 'user_id' => Auth::user()->id])->count();
                    if ($couponCopunt >= 1) {
                        $message = "Opps Coupon availed by you!";
                    }
                }
                //Get all category under coupon
                $categoryArray = explode(",", $couponDetails->categories);
                //Get the cart items
                $userCartItems = Cart::userCartItems();
                if (!empty($couponDetails->users)) {
                    //Get all users under coupon
                    $usersArray = explode(",", $couponDetails->users);
                    foreach ($usersArray  as $key => $user) {
                        $getUserID = User::select('id')->where('email', $user)->first()->toArray();
                        $userID[] = $getUserID['id'];
                    }
                }
                //Get cart total amount
                $total_amount = 0;
                //Check coupon for users and category
                foreach ($userCartItems as $key => $item) {
                    //echo "<pre>"; print_r($item); die;
                    if (!empty($couponDetails->users)) {
                        //User check user coupon
                        if (!in_array($item['user_id'], $userID)) {
                            $message = "This coupon code is not for you";
                        }
                    }
                    //Check if any item belongs to coupon category
                    if (!in_array($item['product']['category_id'], $categoryArray)) {
                        $message = "This coupon code is not for the selected products!";
                    }
                    $attrPrice = Product::getDiscountedAttrPrice($item['product_id'], $item['size']);
                    $total_amount = $total_amount + ($attrPrice['final_price'] * $item['quantity']);
                    //echo "<pre>"; print_r($total_amount); die;
                }
                if (isset($message)) {
                    $userCartItems = Cart::userCartItems();
                    $totalCartItems  = totalCartItems();
                    return response()->json([
                        'status' => false,
                        'message' => $message,
                        'totalCartItems' => $totalCartItems,
                        'view' => (string)View::make('frontend.pages.products.cart_items', compact('userCartItems'))
                    ]);
                } else {
                    //echo "Coupon can be successfull reemed!";
                    if ($couponDetails->amount_type == "fixed") {
                        $couponAmount = $couponDetails->amount;
                    } else {
                        $couponAmount = $total_amount * ($couponDetails->amount / 100);
                    }
                    $grand_total = $total_amount - $couponAmount;
                    //echo $couponAmount; die;
                    //Add Coupon code and amount in session variables
                    Session::put('couponAmount', $couponAmount);
                    Session::put('couponCode', $data['code']);
                    $message = "Coupon code successfully applied. You are availing discount!";
                    $totalCartItems  = totalCartItems();
                    $userCartItems = Cart::userCartItems();
                    return response()->json([
                        'status' => true,
                        'message' => $message,
                        'totalCartItems' => $totalCartItems,
                        'couponAmount' => $couponAmount,
                        'grand_total' => $grand_total,
                        'view' => (string)View::make('frontend.pages.products.cart_items', compact('userCartItems'))
                    ]);
                }
            }
        }
    }
    public function checkout(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            //dd($data);
            if (empty($data['address_id'])) {
                $message = "Please select delivery address";
                return redirect()->back()->with('error', $message);
            }
            if (empty($data['payment_gateway'])) {
                $message = "Please select payment gateway";
                return redirect()->back()->with('success', $message);
            }
            if ($data['payment_gateway'] == "COD") {
                $payment_method = "COD";
            } else {
                echo "Coming soon";
                die;
                $payment_method = "Prepaid";
            }
            //Get Delivary Address
            //$delivery_address = DeliveryAddress::where('id', $data['address_id'])->first()->toArray();
            $delivery_address = DeliveryAddress::deliveryAddress();
            foreach ($delivery_address as $key => $value) {
                $shippingCharges = ShippingCharge::getShippingCharges($value['country']);
                $delivery_address[$key]['shipping_charges'] = $shippingCharges;
            }
            //dd($delivery_address);
            DB::beginTransaction();
            //Insert Into Order Details
            $order = new Order;
            $order->user_id = Auth::user()->id;
            $order->name = $delivery_address['name'];
            $order->address = $delivery_address['address'];
            $order->city = $delivery_address['city'];
            $order->state = $delivery_address['state'];
            $order->country = $delivery_address['country'];
            $order->zip_code = $delivery_address['zip_code'];
            $order->mobile = $delivery_address['mobile'];
            $order->email = Auth::user()->email;
            $order->shipping_charges = 0;
            $order->coupon_code = Session::get('couponCode');
            $order->coupon_amount = Session::get('couponAmount');
            $order->order_status = "New";
            $order->payment_method = $payment_method;
            $order->payment_gateway = $data['payment_gateway'];
            $order->grand_total = Session::get('grand_total');
            $order->save();
            //Get last Order ID
            $order_id = DB::getPdo()->lastInsertId();
            //Get cart items of logged in user that will be order products
            $cartItems = Cart::where('user_id', Auth::user()->id)->get()->toArray();
            foreach ($cartItems as $key => $item) {
                $cartItem = new OrderProduct();
                $cartItem->user_id = Auth::user()->id;
                $cartItem->order_id = $order_id;
                //Get product details of products with added to carts table
                $getProductDetails = Product::select('title', 'code', 'color')->where('id', $item['product_id'])->first()->toArray();
                $cartItem->product_id = $item['product_id'];
                $cartItem->product_name = $getProductDetails['title'];
                $cartItem->product_code = $getProductDetails['code'];
                $cartItem->product_color = $getProductDetails['color'];
                $cartItem->product_size = $item['size'];
                $getDiscountedAttrPrice = Product::getDiscountedAttrPrice($item['product_id'], $item['size']);
                $cartItem->product_price = $getDiscountedAttrPrice['final_price'];
                $cartItem->product_qty = $item['quantity'];
                $cartItem->save();
            }
            Session::put('order_id', $order_id);
            DB::commit();
            if ($data['payment_gateway'] == "COD") {
                $orderDetails = Order::with('order_products')->where('id', $order_id)->first()->toArray();
                //dd($orderDetails);
                //Send order confirmation email to customer
                $email = Auth::user()->email;
                $messageData = [
                    'name' => Auth::user()->name,
                    'email' => $email,
                    'order_id' => $order_id,
                    'orderDetails' => $orderDetails,
                ];
                Mail::send(
                    'emails.order',
                    $messageData,
                    function ($message) use ($email) {
                        $message->to($email);
                        $message->subject('Order Placed Successfully - eCommerce');
                    }
                );
                return redirect()->route('thanks');
            } else {
                echo "Prepaid method is comming soon";
                die;
            }
            echo "Order Placed";
            die;
        }
        $userCartItems = Cart::userCartItems();
        if (count($userCartItems) == 0) {
            return redirect()->route('cart')->with('error', 'Shopping cart is empty! Please add products to checkout');
        }
        $deliveryAddress = DeliveryAddress::deliveryAddress();
        return view('frontend.pages.products.checkout', compact('userCartItems', 'deliveryAddress'));
    }
    public function thanks()
    {
        $data['title'] = "Thanks";
        if (Session::has('order_id')) {
            //Delete Logged in user cart
            Cart::where('user_id', Auth::user()->id)->delete();
            return view('frontend.pages.products.thanks', $data);
        } else {
            return redirect()->route('cart');
        }
    }
    public function addEditDeliveryAddress(Request $request, $id = null)
    {
        if ($id == "") {
            $address = new DeliveryAddress;
            $title = "Add new address";
            $message = "Delivery Address has been saved successfully!";
            $buttonText = "Save";
        } else {
            // Update DeliveryAddress Code
            $address = DeliveryAddress::findOrFail($id);
            $title = "Edit Address";
            $buttonText = "Update";
            $message = "Delivery Address has been updated successfully!";
        }
        //exit;
        try {
            if ($request->isMethod('POST')) {
                $data = $request->all();
                //echo '<pre>';print_r($data);die;
                //Form validation
                $rules = [
                    'name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'address' => 'required|regex:/^[\pL\s\-]+$/u',
                    'country' => 'required',
                    'state' => 'required|regex:/^[\pL\s\-]+$/u',
                    'city' => 'required|regex:/^[\pL\s\-]+$/u',
                    'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|digits:11',
                    'zip_code' => 'required|numeric'
                ];
                $validationMessages = [
                    'name.regex' => 'The name field can not be blank',
                    'country.required' => 'The country field can not be blank',
                    'state.regex' => 'The division field can not be blank',
                    'city.regex' => 'The district field can not be blank',
                    'mobile.digits' => 'The mobile no field must be 11 digits',
                    'mobile.numeric' => 'The mobile no must be numeric',
                    'mobile.required' => 'The mobile no is required',
                    'address.required' => 'The address field can not be blank',
                    'zip_code.digits' => 'The zip code field can not be blank'
                ];
                $this->validate($request, $rules, $validationMessages);
                $address->user_id = Auth::user()->id;
                $address->name = $data['name'];
                $address->country = $data['country'];
                $address->state = $data['state'];
                $address->city = $data['city'];
                $address->mobile = $data['mobile'];
                $address->address = $data['address'];
                $address->zip_code = $data['zip_code'];
                $address->save();
                return redirect()->route('checkout')->with('success', $message);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
        $countries = Country::get()->toArray();
        return view('frontend.pages.user.addEditDeliveryAddress', compact('title', 'countries', 'address', 'buttonText'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeliveryAddress  $deliveryAddress
     * @return \Illuminate\Http\Response
     */
    public function deleteDeliveryAddress($id)
    {
        try {
            $delivery_address = DeliveryAddress::findOrFail($id);
            if (!is_null($delivery_address)) {
                $delivery_address->delete();
                return redirect()->back()->with('success', 'Your address has been deleted!!');
            }
        } catch (\Throwable $th) {
            //dd($th);
            return redirect()->back()->with('error', 'Your product not deleted!!');
        }
    }
}

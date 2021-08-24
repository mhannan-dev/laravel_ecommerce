<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        Session::forget('error_message');
        Session::forget('success_message');
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
            //$userCartItems = Cart::userCartItems();
            //echo "<pre>"; print_r($userCartItems);die;
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
                # check other coupon condition
                $couponDetails = Coupon::where('coupon_code', $data['code'])->first();
                //Check coupon is active or not
                if ($couponDetails->status == 0) {
                    $message = "Coupon is not active!";
                }
                //Check coupon is expired
                $expiry_date = $couponDetails->expiry_date;
                $current_date = date('Y-m-d');
                if ($expiry_date < $current_date) {
                    $message = "Opps Coupon date is expired!";
                }
                //Get all category under coupon
                $categoryArray = explode(",", $couponDetails->categories);
                //dd($categoryArray);
                //Get the cart items
                $userCartItems = Cart::userCartItems();
                //Check if any item belongs to coupon category
                foreach ($userCartItems as $key => $item) {
                    //dd($item);
                    if (!in_array($item['product']['category_id'], $categoryArray)) {
                        $message = "This coupon code is not for gitone of the selected products!";
                    }
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
                }
            }
        }
    }
}

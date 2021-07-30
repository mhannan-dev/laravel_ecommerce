<?php
namespace App\Http\Controllers\Frontend;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
class ProductController extends Controller
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
        $product_details = Product::with(['brand', 'category', 'attributes' => function ($query) {
            $query->where('status', 1);
        }, 'images'])->find($id)->toArray();
        //dd($data['product_details']);
        $total_stock = ProductAttribute::where('product_id', $id)->sum('stock');
        $related_products = Product::where('category_id', $product_details['category']['id'])->where('id', '!=', $id)->get()->toArray();
        //echo "<pre>";
        //print_r($related_products);
        //die;
        return view('frontend.pages.products.detail', compact('product_details', 'total_stock', 'related_products'));
    }
    public function getProductPrice(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $getProductPrice = ProductAttribute::where(['product_id' => $data['product_id'], 'size' => $data['size']])->first();
            return $getProductPrice->price;
        }
    }
    public function addToCart(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            //dd($data);
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
            $countProduct = Cart::where([
                'product_id' => $data['product_id'], 'size' => $data['size']
            ])->count();
            if ($countProduct>0) {
                Session::flash('product_exist_msg', 'This product is already exist in cart');
                return redirect()->back();
            }
            //Save product to cart
            Cart::insert([
                'session_id' => $session_id,
                'product_id' => $data['product_id'],
                'size' => $data['size'],
                'quantity' => $data['quantity'],
            ]);
            Session::flash('product_added_to_cart_msg', 'Product added to cart');
            return redirect()->back();
        }
    }
}

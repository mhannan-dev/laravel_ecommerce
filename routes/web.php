<?php

use App\Models\Coupon;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Frontend\UsersController;
use App\Http\Controllers\Frontend\OrdersController;
use App\Http\Controllers\Frontend\PaypalController;
use App\Http\Controllers\Frontend\ProductsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::namespace('Frontend')->group(function () {
    // Home route
    Route::get('/', [HomeController::class, 'index']);
    // Product Detail
    Route::get('product/{id}', [ProductsController::class, 'detail'])->name('detail');
    $catSlugs = Category::select('slug')->where('status', 1)->get()->pluck('slug')->toArray();
    foreach ($catSlugs as $slug) {
        //Route::get('/' . $slug, [ProductsController::class, 'listing'])->name('slug');
        Route::get('/' . $slug, [ProductsController::class, 'listing']);
    }
    //Get proeuct attributes
    Route::post('get-product-price', [ProductsController::class, 'getProductPrice']);
    //Add to cart
    Route::post('add-to-cart', [ProductsController::class, 'addToCart']);
    //Cart
    Route::get('cart', [ProductsController::class, 'cart'])->name('cart');
    Route::post('update-cart-item-qty', [ProductsController::class, 'updateCartItemQty']);
    Route::post('delete-cart-item', [ProductsController::class, 'deleteCartItem']);
    //Login Register Page
    Route::get('login-register', [UsersController::class, 'loginRegisterPage'])->name('login-register');
    //Login user
    Route::post('login-user', [UsersController::class, 'loginUser']);
    //Register user
    Route::post('register-user', [UsersController::class, 'registerUser']);
    //User logout
    Route::get('logout', [UsersController::class, 'logoutUser']);
    //Check Email and Mobile is Exist
    Route::match(['get', 'post'], 'check-email', [UsersController::class, 'checkEmail']);
    Route::match(['get', 'post'], 'check-mobile', [UsersController::class, 'checkMobileNo']);
    Route::post('check-zip-code', [ProductsController::class, 'checkZipCode']);
    //Confirm user account
    Route::match(['GET', 'POST'], 'confirm/{code}', [UsersController::class, 'confirmAccount']);
    //Auth routes group
    Route::match(['GET', 'POST'], 'forgot-password', [UsersController::class, 'forgotPassword']);
    Route::group(['middleware' => ['auth']], function () {
        Route::match(['GET', 'POST'], '/account', [UsersController::class, 'account'])->name('account');
        Route::post('check-user-password', [UsersController::class, 'checkUserPassword']);
        Route::post('update-user-password', [UsersController::class, 'updateUserPassword']);
        //Apply Coupon
        Route::post('apply-coupon', [ProductsController::class, 'applyCoupon'])->name('apply-coupon');
        //Checkout
        Route::match(['GET', 'POST'], 'checkout', [ProductsController::class, 'checkout'])->name('checkout');
        // Add Edit Delivery Address
        Route::match(['GET', 'POST'], 'add-edit-delivery-address/{id?}', [ProductsController::class, 'addEditDeliveryAddress'])->name('addEditDeliveryAddress');
        Route::post('delete-delivery-address/{id}', [ProductsController::class, 'deleteDeliveryAddress'])->name('deleteDeliveryAddress');
        //Thanks
        Route::get('thanks', [ProductsController::class, 'thanks'])->name('thanks');
        Route::get('paypal', [PaypalController::class, 'paypal'])->name('paypal');
        //Orders
        Route::get('orders', [OrdersController::class, 'orders'])->name('orders');
        Route::get('orders/{id}', [OrdersController::class, 'orderDetails'])->name('orderDetails');
    });
});
Auth::routes();
Route::prefix('sadmin')->namespace('Admin')->group(function () {
    Route::match(['get', 'post'], '/', [AdminController::class, 'login']);
    Route::group(['middleware' => ['admin']], function () {
        Route::get('dashboard', [AdminController::class, 'dashboard']);
        Route::get('settings', [AdminController::class, 'settings']);
        Route::post('check-current-pwd', [AdminController::class, 'check_current_pwd']);
        Route::post('update-current-pwd', [AdminController::class, 'update_current_pwd']);
        Route::match(['get', 'post'], '/profile-update', [AdminController::class, 'profile_update']);
        Route::get('logout',  [AdminController::class, 'logout']);
        //Section
        Route::get('sections', [SectionController::class, 'sections'])->name('sections.index');
        Route::resource('section', '\App\Http\Controllers\Admin\SectionController')->except('index');
        Route::post('update-section-status', [SectionController::class, 'update_section_status']);
        //Category
        Route::get('categories', [CategoryController::class, 'categories'])->name('sadmin.categories');
        Route::resource('category', '\App\Http\Controllers\Admin\CategoryController')->except('index');
        Route::post('update-category-status', [CategoryController::class, 'update_category_status']);
        Route::post('append-category-level', [CategoryController::class, 'append_category_level']);
        //Banner
        Route::get('banners', [BannerController::class, 'banners'])->name('sadmin.banners');
        Route::resource('banner', '\App\Http\Controllers\Admin\BannerController')->except('index');
        Route::post('update-banner-status', [BannerController::class, 'update_banner_status']);
        //Users
        Route::get('users', [UserController::class, 'users']);
        Route::post('update-user-status', [UserController::class, 'update_user_status']);
        //Product
        Route::get('products', [ProductController::class, 'products'])->name('sadmin.products');
        Route::resource('product', '\App\Http\Controllers\Admin\ProductController')->except('index');
        Route::post('update-product-status', [ProductController::class, 'update_product_status']);
        //Images
        Route::match(['get', 'post'], '/add-product-image/{id}', [ProductController::class, 'add_images']);
        Route::get('delete-product-image/{id}', [ProductController::class, 'deleteImage']);
        Route::post('update-image-status', [ProductController::class, 'update_img_status']);
        //Attribute
        Route::match(['get', 'post'], '/add-product-attribute/{id}', [ProductController::class, 'add_attributes']);
        Route::get('delete-attribute/{id}', [ProductController::class, 'delete_attribute']);
        Route::post('update-attribute-status', [ProductController::class, 'update_attribute_status']);
        Route::post('update-attribute', [ProductController::class, 'update_attributes'])->name('update-attribute');
        //Coupon
        Route::get('coupons', [CouponController::class, 'coupons'])->name('sadmin.coupons');
        Route::match(['get', 'post'], 'add-edit-coupon/{id?}', [CouponController::class, 'addEditCoupon']);
        Route::post('update-coupon-status', [CouponController::class, 'updateCouponStatus']);
        Route::post('delete-coupon/{id}', [CouponController::class, 'deleteCoupon']);
        //Orders
        Route::get('orders', [OrderController::class, 'orders'])->name('sadmin.orders');
        Route::get('orderDetail/{id}', [OrderController::class, 'orderDetails'])->name('sadmin.orderDetails');
        Route::post('update-order-status', [OrderController::class, 'updateOrderStatus']);
        Route::get('orderInvoice/{id}', [OrderController::class, 'orderInvoice'])->name('sadmin.orderInvoice');
        Route::get('order-pdf-invoice/{id}', [OrderController::class, 'orderPdfInvoice'])->name('sadmin.orderPdfInvoice');
        //Shipping charge
        Route::get('shipping-charges', [ShippingController::class, 'shippingCharges'])->name('sadmin.shipping-charges');
        Route::match(['get', 'post'], 'add-edit-shipping-charge/{id?}', [ShippingController::class, 'addEditShippingCharge']);
        Route::match(['get', 'post'], 'edit-shipping-charge/{id}', [ShippingController::class, 'editShippingCharge']);
        Route::post('update-shipping-charge-status', [ShippingController::class, 'updateShippingChargeStatus']);
        Route::post('delete-shipping-charge/{id}', [ShippingController::class, 'deleteShippingCharge']);
        Route::match(['get', 'post'], 'check-shipping-area', [ShippingController::class, 'checkShippingChargeArea']);
    });
});
//To clear all cache
Route::get('clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    return "Cleared!";
});

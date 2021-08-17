<?php

use App\Models\Category;
use PhpParser\Node\Stmt\Foreach_;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\UsersController;
use App\Http\Controllers\Frontend\ProductController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::namespace('Frontend')->group(function () {
    // Home route
    Route::get('/', [HomeController::class, 'index']);
    // Product Detail
    Route::get('/product/{id}', [ProductController::class, 'detail']);
    $catSlugs = Category::select('slug')->where('status', 1)->get()->pluck('slug')->toArray();
    foreach ($catSlugs as $slug) {
        Route::get('/' . $slug, [ProductController::class, 'listing'])->name('slug');
    }
    //Get proeuct attributes
    Route::post('get-product-price', [ProductController::class, 'getProductPrice']);
    //Add to cart
    Route::post('add-to-cart', [ProductController::class, 'addToCart']);
    //Cart
    Route::get('cart', [ProductController::class, 'cart']);
    Route::post('update-cart-item-qty', [ProductController::class, 'updateCartItemQty']);
    Route::post('delete-cart-item', [ProductController::class, 'deleteCartItem']);
    //Login Register Page
    Route::get('login-register', [UsersController::class, 'loginRegisterPage']);
    //Login user
    Route::post('login-user', [UsersController::class, 'loginUser']);
    //Register user
    Route::post('register-user', [UsersController::class, 'registerUser']);
    //User logout
    Route::get('logout', [UsersController::class, 'logoutUser']);
    //Check Email and Mobile is Exist
    Route::match(['get', 'post'], 'check-email', [UsersController::class, 'checkEmail']);
    Route::match(['get', 'post'], 'check-mobile', [UsersController::class, 'checkMobileNo']);
    //Confirm user account
    Route::match(['GET', 'POST'], '/confirm/{code}', [UsersController::class, 'confirmAccount']);
    Route::match(['GET', 'POST'], '/forgot-password', [UsersController::class, 'forgotPassword']);
    Route::match(['GET', 'POST'], '/account', [UsersController::class, 'account']);
});
Auth::routes();
Route::prefix('/sadmin')->namespace('Admin')->group(function () {
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
        Route::get('categories', [CategoryController::class, 'categories']);
        Route::resource('category', '\App\Http\Controllers\Admin\CategoryController')->except('index');
        Route::post('update-category-status', [CategoryController::class, 'update_category_status']);
        Route::post('append-category-level', [CategoryController::class, 'append_category_level']);
        //Banner
        Route::get('banners', [BannerController::class, 'banners']);
        Route::resource('banner', '\App\Http\Controllers\Admin\BannerController')->except('index');
        Route::post('update-banner-status', [BannerController::class, 'update_banner_status']);
        //Product
        Route::get('products', [ProductController::class, 'products']);
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
    });
});
//To clear all cache
Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    return "Cleared!";
});

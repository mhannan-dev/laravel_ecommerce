<?php

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use PhpParser\Node\Stmt\Foreach_;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::namespace('Frontend')->group(function () {
    // Home route
    Route::get('/', 'IndexController@index')->name('frontend.home');
    // Product Detail
    Route::get('/product/{id}', 'ProductController@detail')->name('product.detail');
    $catSlugs = Category::select('slug')->where('status', 1)->get()->pluck('slug')->toArray();
    foreach ($catSlugs as $slug) {
        Route::get('/' . $slug, 'ProductController@listing')->name('slug');
    }
    //Get proeuct attributes
    Route::post('get-product-price', 'ProductController@getProductPrice');
    //Add to cart
    Route::post('add-to-cart', 'ProductController@addToCart');
    //Cart
    Route::get('cart', 'ProductController@cart');
    Route::post('update-cart-item-qty', 'ProductController@updateCartItemQty');
    Route::post('delete-cart-item', 'ProductController@deleteCartItem');
    //Login Register Page
    Route::get('/login-register', 'UsersController@loginRegister');
    //Login user
    Route::post('/login', 'UsersController@loginUser');
    //Register user
    Route::post('/register', 'UsersController@registerUser');
});
Auth::routes();
Route::prefix('/admin')->namespace('Admin')->group(function () {
    Route::get('/login', 'AdminController@showLoginForm')->name('admin.loginForm');
    Route::post('/login', 'AdminController@login')->name('admin.login.submit');
    Route::group(['middleware' => ['admin']], function () {
        Route::get('dashboard', 'AdminController@dashboard');
        Route::get('change-password', 'AdminController@change_pwd')->name('change_pwd');
        Route::get('logout', 'AdminController@logout')->name('admin.logout');
        Route::post('check-current-pwd', 'AdminController@check_current_pwd')->name('check_current_pwd');
        Route::post('update-current-pwd', 'AdminController@update_current_pwd')->name('update_current_pwd');
        Route::match(['GET', 'POST'], '/profile-update', 'AdminController@profile_update')->name('profile_update');
        Route::resource('banner', 'BannerController');
        Route::post('update-banner-status', 'BannerController@update_banner_status');
        // Ecommerce sections or product  route
        Route::resource('brand', 'BrandsController');
        Route::post('update-brand-status', 'BrandsController@update_brand_status');
        Route::post('update-section-status', 'SectionController@update_section_status');
        //Category
        Route::resource('category', 'CategoryController');
        Route::post('update-category-status', 'CategoryController@update_category_status');
        Route::post('append-category-level', 'CategoryController@append_category_level');
        //Section
        Route::resource('section', 'SectionController');
        //Product
        Route::resource('product', 'ProductController');
        Route::post('update-product-status', 'ProductController@update_product_status');
        //Attribute
        Route::match(['get', 'post'], 'product-add-attribute/{id}', 'ProductController@add_attributes')->name('add_attribute');
        Route::get('delete-attribute/{id}', 'ProductController@delete_attribute');
        Route::post('update-attribute-status', 'ProductController@update_attribute_status');
        Route::post('edit-attribute', 'ProductController@edit_attributes')->name('edit_attribute');
        //Images
        Route::match(['get', 'post'], 'add-product-image/{id}', 'ProductController@add_images')->name('add.images');
        Route::get('delete-product-image/{id}', 'ProductController@deleteImage');
        Route::post('update-image-status', 'ProductController@update_img_status');
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

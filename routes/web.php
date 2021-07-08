<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::namespace('Frontend')->group(function () {
    Route::get('/', 'IndexController@index')->name('frontend.home'); // Home route
    //Route::get('/{slug}', 'ProductController@listing')->name('listing'); // Listing category route
    Route::get('/{slug}', 'ProductController@listing')->name('slug'); // Listing category route
});
Auth::routes();
Route::prefix('/admin')->namespace('Admin')->group(function () {
    Route::get('/login', 'AdminController@showLoginForm')->name('admin.loginForm');
    Route::post('/login', 'AdminController@login')->name('admin.login.submit');

    Route::group(['middleware' => ['admin']], function () {
        Route::get('dashboard', 'AdminController@dashboard');
        Route::get('change-password', 'AdminController@change_pwd')->name('change_pwd'); //Its settings
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
        Route::match(['get', 'post'], 'add-product-image/{id}', 'ProductController@add_images')->name('add.images');
        Route::match(['get', 'post'], 'product-add-attribute/{id}', 'ProductController@add_attributes')->name('add_attribute');
        Route::get('delete-attribute/{id}', 'ProductController@delete_attribute')->name('delete_attribute');
        Route::get('delete-product-image/{id}', 'ProductController@delete_product_image')->name('delete_product_image');
        Route::post('update-product-image-status', 'ProductController@update_img_status')->name('image_status');
        Route::post('update-product-attr-status', 'ProductController@update_attribute_status');
        Route::post('update-product-status', 'ProductController@update_product_status');
        Route::post('edit-product-attribute', 'ProductController@edit_attributes')->name('edit_attribute');
    });
});
//to clear all cache
Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    return "Cleared!";
});

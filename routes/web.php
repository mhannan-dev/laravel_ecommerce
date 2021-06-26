<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Artisan::call('storage:link', [] );
Route::namespace('Frontend')->group(function () {
    //Home page route
    Route::get('/', 'IndexController@index')->name('frontend.home');
    // Product listing page route
    Route::get('/{url}', 'ProductController@listing')->name('listing');
});
Auth::routes();


Route::prefix('/admin')->namespace('Admin')->group(function () {
    //Route::match(['get', 'post'], '/', 'AdminController@login');
    Route::get('/login', 'AdminController@showLoginForm')->name('admin.loginForm');
    Route::post('/login', 'AdminController@login')->name('admin.login.submit');
    Route::get('/logout', 'AdminController@logout')->name('admin.logout');
    Route::group(['middleware' => ['admin']], function () {
        Route::get('dashboard', 'AdminController@dashboard');
        Route::resource('banner', 'BannerController');
        Route::post('update-banner-status', 'BannerController@update_banner_status');
    });
    Route::group(['prefix' => 'settings'], function () {
        Route::get('change-password', 'AdminController@change_pwd')->name('change_pwd'); //Its settings
        Route::post('check-current-pwd', 'AdminController@check_current_pwd')->name('check_current_pwd');
        Route::post('update-current-pwd', 'AdminController@update_current_pwd')->name('update_current_pwd');
        Route::match(['GET', 'POST'], '/profile-update', 'AdminController@profile_update')->name('profile_update');
    });
    // Ecommerce sections or product  route
    Route::group(['prefix' => 'catalogue'], function () {
        Route::resource('section', 'SectionController');
        Route::resource('brand', 'BrandsController');
        Route::post('update-brand-status', 'BrandsController@update_brand_status');
        Route::post('update-section-status', 'SectionController@update_section_status');
        Route::resource('category', 'CategoryController');
        Route::post('update-category-status', 'CategoryController@update_category_status');
        Route::post('append-category-level', 'CategoryController@append_category_level');
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

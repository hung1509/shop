<?php

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

Auth::routes();
Route::group(['prefix' => 'admin', 'as'=> 'admin.' ],function () {
    Route::get('/', 'AdminController@index')->name('admin');
    // category
    Route::resource('/category', 'CategoryController');
    // product
    Route::resource('/product', 'ProductController');
    // brand
    Route::resource('/brand', 'BrandController');
    // vendor
    Route::resource('/vendor', 'VendorController');
    // user
    Route::resource('/member', 'MemberController');
    // contact
    Route::resource('/contact', 'ContactController');
    //banner
    Route::resource('/banner', 'BannerController');
    // blog
    Route::resource('/blog', 'BlogController');
    //order
    Route::resource('/order', 'OrderController');

});


    Route::get('/', 'ClientController@index')->name('home');
    Route::get('shop', 'ClientController@shop')->name('shop');
    Route::get('shop/detail/{id}', 'ClientController@show')->name('shop.detail');
    Route::get('blog', 'ClientController@blog')->name('blog');
    Route::get('blog/detail/{id}', 'ClientController@blogdetail')->name('blog.detail');
    Route::get('contact', 'ClientController@contact')->name('contact');
    Route::get('about', 'ClientController@aboutus')->name('about');
    Route::get('signin', 'ClientController@signin')->name('signin');
    Route::post('postSignin', 'ClientController@postSignin')->name('postSignin');
    Route::post('signout', 'ClientController@signout')->name('signout');
    Route::post('signup', 'ClientController@signup')->name('signup');
    Route::get('myCart', 'ClientController@myCart')->name('myCart');

    // add to cart
    Route::get('product/add-to-cart/{id}', 'ClientController@addToCart')->name('addToCart');
    Route::get('product/remove-form-cart/{id}', 'ClientController@removeFormCart')->name('removeFormCart');
    Route::get('product/update-cart/{id}', 'ClientController@updateCart')->name('updateCart');
    Route::get('product/remove-cart', 'ClientController@removeCart')->name('removeCart');
    
    //account
    Route::get('/myAccount/{id}', 'AccountController@index')->name('myAccount');
    // checkout
    Route::get('/checkout', 'ClientController@checkout')->name('checkout');
    Route::get('/updateAcc', 'ClientController@updateAcc')->name('updateAcc');
    // cancel
    Route::get('/cancelOrder/{id}', 'OrderController@cancel')->name('cancel');
    //confirm
    Route::get('/confirmOrder/{id}', 'OrderController@confirm')->name('confirm');
    //back
    Route::get('/back', 'OrderController@back')->name('back');
    // detail
    Route::get('/orderDetail/{id}', 'ClientController@orderDetail')->name('orderDetail');



    













<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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


Route::get('/', 'Frontend\CollectionController@homeindex');

Auth::routes();


// Collections
Route::get('collections', 'Frontend\CollectionController@index');
Route::get('collection/{group_url}', 'Frontend\CollectionController@groupview');
Route::get('collection/{group_url}/{cate_url}', 'Frontend\CollectionController@categoryview');
Route::get('collection/{group_url}/{cate_url}/{subcate_url}', 'Frontend\CollectionController@subcategoryview');
Route::get('collection/{group_url}/{cate_url}/{subcate_url}/{prod_url}/{prod_id}', 'Frontend\CollectionController@productview');

Route::get('vendor/{vendor_name}.{vendor_id}', 'Frontend\CollectionController@vendorview');

// cart
Route::post('add-to-cart', 'Frontend\CartController@addtocart');
Route::get('/cart', 'Frontend\CartController@index');
Route::get('/load-cart-data', 'Frontend\CartController@cartloadbyajax');
Route::post('update-to-cart', 'Frontend\CartController@updatetocart');
Route::delete('delete-from-cart', 'Frontend\CartController@deletefromcart');
Route::get('clear-cart', 'Frontend\CartController@clearcart');
Route::get('thank-you', 'Frontend\CartController@thankyou');


// Review
Route::post('store-reviews', 'Frontend\ReviewController@store');

// Like, Unlike
Route::post('store-like', 'Frontend\LikeController@storelike');
Route::post('store-unlike', 'Frontend\LikeController@storeunlike');

// Search Autofill
Route::get('/searchajax', 'Frontend\CartController@SearchautoComplete')->name('searchproductajax');
Route::post('/search', 'Frontend\CartController@result');

// Search
Route::get('search', 'Frontend\CollectionController@prodsearch');
Route::get('URL::current()', 'Frontend\CollectionController@subcategoryview'); //collection -  product search


// from kernel.php (user)
Route::group(['middleware' => ['auth', 'isUser']], function () {

	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/me/{user_name}', 'Frontend\UserController@myprofile');
	Route::post('/my-profile-update', 'Frontend\UserController@profileupdate');
	Route::post('/password-update', 'Frontend\UserController@passwordupdate');
	Route::post('/propic-update', 'Frontend\UserController@propicupdate');

	// Wishlist
	Route::get('/wishlist', 'Frontend\WishlistController@index');
	Route::post('/add-wishlist', 'Frontend\WishlistController@storewishlist');
	Route::post('/remove-from-wishlist', 'Frontend\WishlistController@removewishlist');


	// Activity Log
	Route::get('activityall/{user_name}', 'Frontend\ActivityController@activityindex');
	Route::get('orders/{user_name}', 'Frontend\UserController@orderindex');
	Route::get('voucher/{order_id}/{user_name}', 'Frontend\UserController@voucherindex');

	// Coupon code
	Route::post('check-coupon-code', 'Frontend\CheckoutController@checkingcoupon');


	// Checkout
	Route::get('checkout', 'Frontend\CheckoutController@index');
	Route::post('/place-order', 'Frontend\CheckoutController@storeorder');
	Route::post('/place-order-stripe', 'Frontend\CheckoutController@storeorderstripe');
	Route::post('/confirm-razorpay-payment', 'Frontend\CheckoutController@checkamount');
});


// group routes (admin)
Route::group(['middleware' => ['auth', 'isAdmin']], function () {

	Route::get('/dashboard', function () {
		return view('admin.dashboard');
	});

	Route::get('registered-user', 'Admin\RegisteredController@index');
	Route::get('role-edit/{id}/{name}', 'Admin\RegisteredController@edit');
	Route::post('role-update/{id}', 'Admin\RegisteredController@updaterole');

	// groups
	Route::get('group', 'Admin\GroupController@index');
	Route::get('group-add', 'Admin\GroupController@viewpage');
	Route::post('group-store', 'Admin\GroupController@store');
	Route::get('group-edit/{id}/{name}', 'Admin\GroupController@edit');
	Route::put('group-update/{id}', 'Admin\GroupController@update');
	Route::get('group-delete/{id}', 'Admin\GroupController@delete');
	Route::get('group-deleted-records', 'Admin\GroupController@deletedrecords');
	Route::get('group-re-store/{id}', 'Admin\GroupController@deletedrestore');


	// category
	Route::get('/category', 'Admin\CategoryController@index');
	Route::get('category-add', 'Admin\CategoryController@create');
	Route::post('/category-store', 'Admin\CategoryController@store');
	Route::get('category-edit/{id}/{name}', 'Admin\CategoryController@edit');
	Route::put('category-update/{id}', 'Admin\CategoryController@update');
	Route::get('category-delete/{id}', 'Admin\CategoryController@delete');
	Route::get('category-deleted-records', 'Admin\CategoryController@deletedrecords');
	Route::get('category-re-store/{id}', 'Admin\CategoryController@deletedrestore');


	// sub-category
	Route::get('sub-category', 'Admin\SubcategoryController@index');
	Route::post('sub-category-store', 'Admin\SubcategoryController@create');
	Route::get('sub-category-edit/{id}/{name}', 'Admin\SubcategoryController@edit');
	Route::put('sub-category-update/{id}', 'Admin\SubcategoryController@update');
	Route::get('sub-category-delete/{id}', 'Admin\SubcategoryController@delete');
	Route::get('subcategory-deleted-records', 'Admin\SubcategoryController@deletedrecords');
	Route::get('subcategory-re-store/{id}', 'Admin\SubcategoryController@deletedrestore');


	// products
	Route::get('/products', 'Admin\ProductController@index');
	Route::get('add-products', 'Admin\ProductController@create');
	Route::post('store-products', 'Admin\ProductController@store');
	Route::get('product-edit/{id}/{name}', 'Admin\ProductController@edit');
	Route::put('update-product/{id}', 'Admin\ProductController@update');
	Route::get('product-delete/{id}', 'Admin\ProductController@delete');
	Route::get('product-deleted-records', 'Admin\ProductController@deletedrecords');
	Route::get('product-re-store/{id}', 'Admin\ProductController@deletedrestore');


	// Order Management
	Route::get('orders', 'Admin\OrderController@index');
	Route::get('order-view/{id}', 'Admin\OrderController@vieworder');
	Route::get('generate-invoice/{order_id}', 'Admin\OrderController@generateinvoice');

	Route::get('order-proceed/{order_id}', 'Admin\OrderController@proceedorder');
	Route::put('order/update-tracking-status/{order_id}', 'Admin\OrderController@trackingstatus');
	Route::put('order/cancel-order/{order_id}', 'Admin\OrderController@cancelorder');
	Route::put('order/complete-order/{order_id}', 'Admin\OrderController@completeorder');

	// coupon
	Route::get('admin/coupon-view', 'Admin\CouponController@index');
	Route::post('coupon-store', 'Admin\CouponController@store');
	Route::get('admin/coupon-edit/{id}', 'Admin\CouponController@edit');
	Route::put('coupon-update/{id}', 'Admin\CouponController@update');
});

// group route (vendor)
Route::group(['middleware' => ['auth', 'isVendor']], function () {

	Route::get('/vendor-dashboard', function () {
		return view('vendor.dashboard');
	});
});

<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Home page
Route::get('/', 'App\Http\Controllers\Frontend\CollectionController@homeindex');
Route::get('/new-arrivals', 'App\Http\Controllers\Frontend\CollectionController@newarrivals');
Route::get('/sellers', 'App\Http\Controllers\Frontend\CollectionController@sellers');


// Collections
Route::get('/collections', 'App\Http\Controllers\Frontend\CollectionController@index');
Route::get('collection/{group_url}', 'App\Http\Controllers\Frontend\CollectionController@groupview');
Route::get('collection/{group_url}/{cate_url}', 'App\Http\Controllers\Frontend\CollectionController@categoryview');
Route::get('collection/{group_url}/{cate_url}/{subcate_url}', 'App\Http\Controllers\Frontend\CollectionController@subcategoryview');
Route::get('collection/{group_url}/{cate_url}/{subcate_url}/{prod_url}/{prod_id}', 'App\Http\Controllers\Frontend\CollectionController@productview');

// Advertise
Route::get('ad/{link}', 'App\Http\Controllers\Frontend\CollectionController@adindex');


// Vendor profile view
Route::get('vp/{vendor_name}/{vendor_id}', 'App\Http\Controllers\Frontend\CollectionController@vendorview');


// cart
Route::post('add-to-cart', 'App\Http\Controllers\Frontend\CartController@addtocart');
Route::get('/cart', 'App\Http\Controllers\Frontend\CartController@index');
Route::get('/load-cart-data', 'App\Http\Controllers\Frontend\CartController@cartloadbyajax');
Route::post('update-to-cart', 'App\Http\Controllers\Frontend\CartController@updatetocart');
Route::delete('delete-from-cart', 'App\Http\Controllers\Frontend\CartController@deletefromcart');
Route::get('clear-cart', 'App\Http\Controllers\Frontend\CartController@clearcart');
Route::get('thank-you', 'App\Http\Controllers\Frontend\CartController@thankyou');


// Review
Route::post('store-reviews', 'App\Http\Controllers\Frontend\ReviewController@store');

// Like, Unlike
Route::post('store-like', 'App\Http\Controllers\Frontend\LikeController@storelike');
Route::post('store-unlike', 'App\Http\Controllers\Frontend\LikeController@storeunlike');

// Search autocomplete
Route::get('/searchajax', 'App\Http\Controllers\Frontend\CollectionController@SearchautoComplete')->name('searchproductajax');
Route::post('/search', 'App\Http\Controllers\Frontend\CollectionController@result');

// Search
Route::get('search', 'App\Http\Controllers\Frontend\CollectionController@prodsearch');






// USER ROUTES (isUser is from Kernel.php)
Route::group(['middleware' => ['auth', 'isUser']], function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Profile controller
    Route::get('/me/{user_name}', 'App\Http\Controllers\Frontend\UserController@myprofile');
    Route::post('/my-profile-update/{id}', 'App\Http\Controllers\Frontend\UserController@profileupdate');
    Route::post('/password-update/{id}', 'App\Http\Controllers\Frontend\UserController@passwordupdate');
    Route::post('/propic-update/{id}', 'App\Http\Controllers\Frontend\UserController@propicupdate');

    // Request Vendor
    Route::post('/req-vendor/{id}', 'App\Http\Controllers\Frontend\UserController@reqvendor');
    Route::post('/check-user', 'App\Http\Controllers\Frontend\UserController@checkuser');



    // WishList
    Route::get('/wishlist', 'App\Http\Controllers\Frontend\WishlistController@index');
    Route::post('/add-wishlist', 'App\Http\Controllers\Frontend\WishlistController@storewishlist');
    Route::post('/remove-from-wishlist', 'App\Http\Controllers\Frontend\WishlistController@removewishlist');

    // Activity log / Orders / Voucher
    Route::get('activityall/{user_name}', 'App\Http\Controllers\Frontend\ActivityController@activityindex');


    // Coupon code

    // Checkout

});


// ADMIN ROUTES (isAdmin is from Kernel.php)
Route::group(['middleware' => ['auth', 'isAdmin']], function (){

    // Dashboard
    Route::get('/dashboard', 'App\Http\Controllers\Admin\DashboardController@index');

    // Profile Controller
    Route::get('/admin/{user_name}', 'App\Http\Controllers\Admin\ProfileController@myprofile');
    Route::post('/my-profile-update', 'App\Http\Controllers\Admin\ProfileController@profileupdate');
    Route::post('/propic-update', 'App\Http\Controllers\Admin\ProfileController@propicupdate');
    Route::post('/password-update', 'App\Http\Controllers\Admin\ProfileController@passwordupdate');

    // Notifications

    // Vendor Request confirm
    Route::get('/vendor-requests', 'App\Http\Controllers\Admin\RequestVendorController@index');
    Route::get('/vendor-request-confirm/{id}', 'App\Http\Controllers\Admin\RequestVendorController@confirm');
    Route::post('vendor-confirmed/{id}', 'App\Http\Controllers\Admin\RequestVendorController@confirmed');


    // Slider for Advertising


    // Registered users (manage users)
    Route::get('registered-user', 'App\Http\Controllers\Admin\RegisteredController@index');
    Route::get('role-edit/{id}/{name}', 'App\Http\Controllers\Admin\RegisteredController@edit');
    Route::post('role-update/{id}', 'App\Http\Controllers\Admin\RegisteredController@updaterole');


    // Groups
    Route::get("/groups", 'App\Http\Controllers\Admin\GroupController@index');
    Route::get('/group-add', 'App\Http\Controllers\Admin\GroupController@groupadd');
    Route::post('/group-store', 'App\Http\Controllers\Admin\GroupController@store');
    Route::get('group-edit/{id}/{name}', 'App\Http\Controllers\Admin\GroupController@edit');
    Route::put('group-update/{id}', 'App\Http\Controllers\Admin\GroupController@update');
    Route::get('group-delete/{id}', 'App\Http\Controllers\Admin\GroupController@delete');
    Route::get('group-deleted-records', 'App\Http\Controllers\Admin\GroupController@deletedrecords');
	Route::get('group-re-store/{id}', 'App\Http\Controllers\Admin\GroupController@deletedrestore');
	Route::get('delete-group-trash/{id}', 'App\Http\Controllers\Admin\GroupController@deletetrash');
	Route::get('empty-group-trash', 'App\Http\Controllers\Admin\GroupController@emptytrash');

    // category
    Route::get('/category', 'App\Http\Controllers\Admin\CategoryController@index');
    Route::get('category-add', 'App\Http\Controllers\Admin\CategoryController@create');
    Route::post('/category-store', 'App\Http\Controllers\Admin\CategoryController@store');
    Route::get('category-edit/{id}/{name}', 'App\Http\Controllers\Admin\CategoryController@edit');
    Route::put('category-update/{id}', 'App\Http\Controllers\Admin\CategoryController@update');
    Route::get('category-delete/{id}', 'App\Http\Controllers\Admin\CategoryController@delete');
    Route::get('category-deleted-records', 'App\Http\Controllers\Admin\CategoryController@deletedrecords');
    Route::get('category-re-store/{id}', 'App\Http\Controllers\Admin\CategoryController@deletedrestore');
    Route::get('delete-category-trash/{id}', 'App\Http\Controllers\Admin\CategoryController@deletetrash');
    Route::get('empty-category-trash', 'App\Http\Controllers\Admin\CategoryController@emptytrash');

    // sub-category
    Route::get('sub-category', 'App\Http\Controllers\Admin\SubcategoryController@index');
    Route::post('sub-category-store', 'App\Http\Controllers\Admin\SubcategoryController@create');
    Route::get('sub-category-edit/{id}/{name}', 'App\Http\Controllers\Admin\SubcategoryController@edit');
    Route::put('sub-category-update/{id}', 'App\Http\Controllers\Admin\SubcategoryController@update');
    Route::get('sub-category-delete/{id}', 'App\Http\Controllers\Admin\SubcategoryController@delete');
    Route::get('subcategory-deleted-records', 'App\Http\Controllers\Admin\SubcategoryController@deletedrecords');
    Route::get('subcategory-re-store/{id}', 'App\Http\Controllers\Admin\SubcategoryController@deletedrestore');
    Route::get('delete-subcategory-trash/{id}', 'App\Http\Controllers\Admin\SubcategoryController@deletetrash');
    Route::get('empty-subcategory-trash', 'App\Http\Controllers\Admin\SubcategoryController@emptytrash');

    // products
    Route::get('/products', 'App\Http\Controllers\Admin\ProductController@index');
    Route::get('add-products', 'App\Http\Controllers\Admin\ProductController@create');
    Route::post('store-products', 'App\Http\Controllers\Admin\ProductController@store');
    Route::get('product-edit/{id}/{name}', 'App\Http\Controllers\Admin\ProductController@edit');
    Route::put('update-product/{id}', 'App\Http\Controllers\Admin\ProductController@update');
    Route::get('product-delete/{id}', 'App\Http\Controllers\Admin\ProductController@delete');
    Route::get('product-deleted-records', 'App\Http\Controllers\Admin\ProductController@deletedrecords');
    Route::get('product-re-store/{id}', 'App\Http\Controllers\Admin\ProductController@deletedrestore');
    Route::get('delete-product-trash/{id}', 'App\Http\Controllers\Admin\ProductController@deletetrash');
    Route::get('empty-product-trash', 'App\Http\Controllers\Admin\ProductController@emptytrash');


    // Order management

    // coupon

});



// VENDOR ROUTES
Route::group(['middleware' => ['auth', 'isVendor']], function () {

    // Vendor Dashboard
    Route::get('/vendor-dashboard', 'App\Http\Controllers\Vendor\VendorDashboardController@index');

    // Products
    Route::get('/vendor/products', 'App\Http\Controllers\Vendor\ProductController@index');
    Route::get('/vendor/add-products', 'App\Http\Controllers\Vendor\ProductController@add');
    Route::post('/vendor/store-products', 'App\Http\Controllers\Vendor\ProductController@store');
    Route::get('/vendor/product-edit/{id}/{name}', 'App\Http\Controllers\Vendor\ProductController@edit');
    Route::put('/vendor/update-product/{id}', 'App\Http\Controllers\Vendor\ProductController@update');
    Route::get('/vendor/product-delete/{id}', 'App\Http\Controllers\Vendor\ProductController@delete');
    Route::get('/vendor/product-deleted-records', 'App\Http\Controllers\Vendor\ProductController@deletedrecords');
    Route::get('/vendor/product-re-store/{id}', 'App\Http\Controllers\Vendor\ProductController@deletedrestore');
    Route::get('/vendor/delete-product-trash/{id}', 'App\Http\Controllers\Vendor\ProductController@deletetrash');
    Route::get('/vendor/empty-product-trash', 'App\Http\Controllers\Vendor\ProductController@emptytrash');


    // Advertising
    Route::get('vendor/manage-ads', 'App\Http\Controllers\Vendor\AdController@index');
    Route::get('vendor/create-ads', 'App\Http\Controllers\Vendor\AdController@create');
    Route::post('vendor/store-ad', 'App\Http\Controllers\Vendor\AdController@store');
    Route::get('vendor/edit-ad/{id}', 'App\Http\Controllers\Vendor\AdController@edit');
    Route::put('vendor/update-ad/{id}', 'App\Http\Controllers\Vendor\AdController@update');

    Route::get('vendor/ad-prods/{id}', 'App\Http\Controllers\Vendor\AdController@adprod');
    Route::post('vendor/ad-prod-store/{id}', 'App\Http\Controllers\Vendor\AdController@adprodstore');


    // Coupons

    // Customers

    // Order management
});

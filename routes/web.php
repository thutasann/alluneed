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

Route::get('/', function () {
    return view('frontend.index');
});


Auth::routes();



// USER ROUTES (isAdmin is from Kernel.php)
Route::group(['middleware' => ['auth', 'isUser']], function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Profile controller
    Route::get('/me/{user_name}', 'App\Http\Controllers\Frontend\UserController@myprofile');
    Route::post('/my-profile-update/{id}', 'App\Http\Controllers\Frontend\UserController@profileupdate');
    Route::post('/password-update/{id}', 'App\Http\Controllers\Frontend\UserController@passwordupdate');
    Route::post('/propic-update/{id}', 'App\Http\Controllers\Frontend\UserController@propicupdate');

});


// ADMIN ROUTES (isAdmin is from Kernel.php)
Route::group(['middleware' => ['auth', 'isAdmin']], function (){

    // Dashboard
    Route::get('/dashboard', 'App\Http\Controllers\Admin\DashboardController@index');


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



});



// VENDOR ROUTES
Route::group(['middleware' => ['auth', 'isVendor']], function () {

    Route::get('/vendor-dashboard', function () {
        return view('vendor.dashboard');
    });
});

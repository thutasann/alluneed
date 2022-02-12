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



// ADMIN ROUTES (isAdmin is from Kernel.php)
Route::group(['middleware' => ['auth', 'isUser']], function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

});


// ADMIN ROUTES (isAdmin is from Kernel.php)
Route::group(['middleware' => ['auth', 'isAdmin']], function (){

    // Dashboard
    Route::get('/dashboard', 'App\Http\Controllers\Admin\DashboardController@index');


    // Registered users (manage users)
    Route::get('registered-user', 'App\Http\Controllers\Admin\RegisteredController@index');
    Route::get('role-edit/{id}/{name}', 'App\Http\Controllers\Admin\RegisteredController@edit');
    Route::post('role-update/{id}', 'App\Http\Controllers\Admin\RegisteredController@updaterole');

});



// VENDOR ROUTES
Route::group(['middleware' => ['auth', 'isVendor']], function () {

    Route::get('/vendor-dashboard', function () {
        return view('vendor.dashboard');
    });
});

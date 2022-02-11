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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// ADMIN ROUTES (isAdmin is from Kernel.php)
Route::group(['middleware' => ['auth', 'isAdmin']], function (){

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

});



//
Route::group(['middleware' => ['auth', 'isVendor']], function () {

    Route::get('/vendor-dashboard', function () {
        return view('vendor.dashboard');
    });
});

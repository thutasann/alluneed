<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Models\Groups;
use App\Models\Models\Category;
use App\Models\Models\Subcategory;
use App\Models\Models\Products;
use App\Models\Models\Order;
use App\Models\Models\Coupon;
use App\Models\Models\Slider;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user_all =  User::all();
        $groups = Groups::where('status', '!=', '2')->get();
        $categories = Category::where('status', '!=', '3')->get();
        $subcategories = Subcategory::where('status', '!=', '3')->get();
        $products = Products::where('status', '!=', '3')->get();
        $orders = Order::all();
        $coupons = Coupon::all();
        $sliders = Slider::all();


        return view('admin.dashboard')->with('user_all', $user_all)
            ->with('groups', $groups)
            ->with('categories', $categories)
            ->with('subcategories', $subcategories)
            ->with('products', $products)
            ->with('orders', $orders)
            ->with('coupons', $coupons)
            ->with('sliders', $sliders);
    }
}

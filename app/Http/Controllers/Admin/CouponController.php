<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Products;

class CouponController extends Controller
{
    public function index()
    {
        $product = Products::where('status', '0')->get();
        $coupon = Coupon::all();
        return view('admin.coupon.index', compact('product', 'coupon'));
    }

    public function store(Request $request)
    {
        $coupon = new Coupon();
        $coupon->offer_name = $request->input('offer_name');
        $coupon->product_id = $request->input('product_id');
        $coupon->coupon_code = $request->input('coupon_code');
        $coupon->coupon_limit = $request->input('coupon_limit');
        $coupon->coupon_type = $request->input('coupon_type');
        $coupon->coupon_price = $request->input('coupon_price');
        $coupon->start_datetime = $request->input('start_datetime');
        $coupon->end_datetime = $request->input('end_datetime');
        $coupon->status = $request->input('status') == true ? '1' : '0';
        $coupon->visibility_status = $request->input('visibility_status') == true ? '1' : '0';
        $coupon->save();

        return redirect()->back()->with('status', 'Coupon Added Successfully');
    }

    public function edit($id)
    {
        $coupon = Coupon::find($id);
        $product = Products::where('status', '0')->get();

        return view('admin.coupon.edit', compact('coupon', 'product'));
    }

    public function update(Request $request, $id)
    {
        $coupon = Coupon::find($id);
        $coupon->offer_name = $request->input('offer_name');
        $coupon->product_id = $request->input('product_id');
        $coupon->coupon_code = $request->input('coupon_code');
        $coupon->coupon_limit = $request->input('coupon_limit');
        $coupon->coupon_type = $request->input('coupon_type');
        $coupon->coupon_price = $request->input('coupon_price');
        $coupon->start_datetime = $request->input('start_datetime');
        $coupon->end_datetime = $request->input('end_datetime');
        $coupon->status = $request->input('status') == true ? '1' : '0';
        $coupon->visibility_status = $request->input('visibility_status') == true ? '1' : '0';
        $coupon->update();
        return redirect()->back()->with('status', 'Coupon Updated Successfully');
    }
}

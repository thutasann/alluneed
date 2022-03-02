<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Mail\CouponSendMailable;
use App\Models\Models\Coupon;
use App\Models\Models\Coupon_user;
use App\Models\Models\Products;
use App\Models\Models\Request_vendor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class CouponController extends Controller
{
    private function encrypt_decrypt($action, $string)
    {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_iv = 'This is my secret iv';
        $secret_key = '1f4276388ad3214c873428dbef42243f';
        $key = hash('sha256', $secret_key);
        $iv = substr(hash(
            'sha256',
            $secret_iv
        ), 0, 16);

        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if ($action == 'decrypt') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }

    public function vcoupon()
    {
        $user_id = Auth::user()->id;
        $product = Products::where('status', '0')->where('vendor_id', $user_id)->get();
        $coupon = Coupon::where('vendor_id', $user_id)->get();

        return view('vendor.coupon.index', compact('product', 'coupon'));
    }

    public function store(Request $request)
    {
        $coupon = new Coupon();
        $coupon->offer_name = $request->input('offer_name');
        $coupon->product_id = $request->input('product_id');
        $coupon->vendor_id = $request->input('vendor_id');
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
        $user_id = Auth::user()->id;
        $decrypted = $this->encrypt_decrypt('decrypt', $id);

        $product = Products::where('status', '0')->where('vendor_id', $user_id)->get();
        $coupon = Coupon::find($decrypted);
        $users = User::all();

        $vendor = Request_vendor::where('user_id', $user_id)->first();

        $coupon_users = Coupon_user::where('coupon_id', $decrypted)->get();

        return view('vendor.coupon.edit', compact('product', 'coupon', 'users', 'vendor', 'coupon_users'));
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

    private function CouponSendMailable(Request $request, $id)
    {
        $cdata =
            [
                'vendor_name' => $request->input('vendor_name'),
                'vendor_email' => $request->input('vendor_email'),
                'user_email' => $request->input('user_email'),
                'offer_name' => $request->input('offer_name'),
                'coupon_code' => $request->input('coupon_code'),
                'start_datetime' => $request->input('start_datetime'),
                'end_datetime' => $request->input('end_datetime'),
                'id' => $id,
            ];

        $to_customer_email = $request->input('user_email');
        Mail::to($to_customer_email)->send(new CouponSendMailable($cdata));
    }

    public function sendcoupon(Request $request, $id)
    {
        $vendor_name = $request->input('vendor_name');
        $vendor_email = $request->input('vendor_email');
        $user_email = $request->input('user_email');
        $offer_name = $request->input('offer_name');
        $coupon_code = $request->input('coupon_code');
        $start_datetime = $request->input('start_datetime');
        $end_datetime = $request->input('end_datetime');

        $coupon_user = new Coupon_user();
        $coupon_user->coupon_id = $id;
        $coupon_user->user_email = $user_email;
        $coupon_user->save();

        // Send Mail
        $this->CouponSendMailable($request, $id);

        return redirect()->back()->with('status-sent', 'This Coupon was sent successfully!');
    }
}

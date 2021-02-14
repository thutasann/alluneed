<?php

namespace App\Http\Controllers\Frontend;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
// use File;

use App\Models\ActivityLog;
use App\Models\Products;
use App\Models\Order;
use App\Models\Orderitem;



class UserController extends Controller
{
    public function myprofile($user_name)
    {

        // Activity log ---
        $user_id = Auth::user()->id;
        $activities = new ActivityLog();
        $activities->user_id = $user_id;
        $activities->type = 'profile view';
        $activities->save();
        // Activity log ---

        return view('frontend.user.profile');
    }

    public function profileupdate(Request $request)
    {
        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);

        $user->name = $request->input('fname');
        $user->Iname = $request->input('Iname');
        $user->address1 = $request->input('address1');
        $user->address2 = $request->input('address2');
        $user->country = $request->input('country');
        $user->city = $request->input('city');
        $user->state = $request->input('state');
        $user->pincode = $request->input('pincode');
        $user->phone = $request->input('phone');
        $user->alternate_phone = $request->input('alternate_phone');
        $user->role_as = $request->input('roles') == true ? 'vendor' : '';


        // Activity log ---
        $activities = new ActivityLog();
        $activities->user_id = $user_id;
        $activities->type = 'profile update';
        $activities->save();
        // Activity log ---

        $user->update();
    }

    public function propicupdate(Request $request)
    {

        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);

        if ($request->hasfile('Image')) {
            $destination = 'uploads/profile/' . $user->Image;

            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('Image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/profile/', $filename);
            $user->image = $filename;
        }

        // Activity log ---
        $activities = new ActivityLog();
        $activities->user_id = $user_id;
        $activities->type = 'profile update';
        $activities->save();
        // Activity log ---

        $user->update();
        return redirect()->back()->with('statuspic', 'Profile Image Updated !');
    }

    public function passwordupdate(Request $request)
    {
        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);

        $user->password = bcrypt($request->input('newpsw'));

        $user->update();
        Auth::logout();
        return redirect('/login')->with('status-password', 'Password Updated Successfully, Please Login again!');
    }

    public function orderindex($user_name)
    {

        $user_id = Auth::user()->id;
        $orders = Order::where('user_id', $user_id)
            ->get();

        return view('frontend.user.orderlist')->with('orders', $orders);
    }

    private function encrypt_decrypt($action, $string)
    {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_iv = 'This is my secret iv';
        $secret_key = '1f4276388ad3214c873428dbef42243f';
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if ($action == 'decrypt') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }

    public function voucherindex($order_id, $user_name)
    {
        $dorder_id = $this->encrypt_decrypt('decrypt', $order_id);
        $user_id = Auth::user()->id;

        $order = Order::where('id', $dorder_id)
            ->where('user_id', $user_id)
            ->get();

        $orderitem = Orderitem::where('order_id', $dorder_id)
            ->get();

        return view('frontend.user.invoice')->with('orderitem', $orderitem)
            ->with('order', $order);
    }
}

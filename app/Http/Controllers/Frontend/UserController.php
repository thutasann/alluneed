<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Models\ActivityLog;
use App\Models\Models\Order;
use App\Models\Models\Orderitem;
use App\Models\Models\Request_vendor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;



class UserController extends Controller
{
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

    public function myprofile($user_name)
    {
        // Activity log ---
        $user_id = Auth::user()->id;
        $activities = new ActivityLog();
        $activities->user_id = $user_id;
        $activities->type = 'profile view';
        $activities->save();
        // Activity log ---

        $user_id = Auth::user()->id;
        $req_pending = Request_vendor::where('user_id', $user_id)->where('confirm', '0')->first();
        $vendor_name = Request_vendor::where('user_id', $user_id)->where('confirm', '1')->get();

        return view('frontend.user.profile')->with('req_pending', $req_pending)
        ->with('vendor_name', $vendor_name);
    }

    public function profileupdate(Request $request, $id)
    {

        $user = User::findOrFail($id);

        $user->name = $request->input('fname');
        $user->lname = $request->input('lname');
        $user->address1 = $request->input('address1');
        $user->address2 = $request->input('address2');
        $user->country = $request->input('country');
        $user->city = $request->input('city');
        $user->state = $request->input('state');
        $user->pincode = $request->input('pincode');
        $user->phone = $request->input('phone');
        $user->alternate_phone = $request->input('alternate_phone');
        $user->update();
        // return redirect()->back()->with('status', 'Updated Successfully');

    }

    public function propicupdate(Request $request, $id)
    {
        $user = User::findOrFail($id);

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

        $user->update();
        return redirect()->back()->with('statuspic', 'Profile Image was Updated !');
    }

    public function passwordupdate(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->password = bcrypt($request->input('newpsw'));

        $user->update();
        Auth::logout();
        return redirect('/login')->with('status-password', 'Password Updated Successfully, Please Login again!');
    }



    public function reqvendor(Request $request, $id)
    {

        if (isset($_POST['place_order_razorpay'])) {

            $request_v = new Request_vendor();
            $request_v->user_id = $id;
            $request_v->vendor_name = $request->input('vendor_name');
            $request_v->description = $request->input('description');
            $request_v->payment_mode = "Payment by Razorpay";
            $request_v->payment_id = $request->input('razorpay_payment_id');
            $request_v->payment_status = "2";
            $request_v->save();
            return redirect()->back()->with('status_req', 'Your Vendor Request was sent to Admin.');
        }
    }

    // for razorpay
    public function checkuser(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $vendor_name = $request->input('vendor_name');
        $description = $request->input('description');


        if ($name || $email || $vendor_name || $description) {
            return response()->json([
                'user_id' => $request->user_id,
                'name' => $request->name,
                'email' => $request->email,
                'vendor_name' => $request->vendor_name,
                'description' => $request->description,
            ]);
        }
    }


    public function orderindex($user_name)
    {

        $user_id = Auth::user()->id;
        $orders = Order::where('user_id', $user_id)
            ->get();

        return view('frontend.user.orderlist')->with('orders', $orders);
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

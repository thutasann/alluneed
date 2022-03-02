<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Models\ActivityLog;
use App\Models\Models\Request_vendor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;



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


}

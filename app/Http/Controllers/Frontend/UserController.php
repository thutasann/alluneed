<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;



class UserController extends Controller
{
    public function myprofile($user_name)
    {
        $user_id = Auth::user()->id;
        return view('frontend.user.profile');
    }

    public function profileupdate(Request $request, $id)
    {

        $user = User::findOrFail($id);

        $user->name = $request->input('fname');
        $user->lname = $request->input('Iname');
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
}

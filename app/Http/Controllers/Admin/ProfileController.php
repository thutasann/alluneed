<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function myprofile($user_name)
    {
        return view('admin.profile.profile');
    }

    public function profileupdate(Request $request)
    {
        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);

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
        $user->role_as = Auth::user()->role_as;

        $user->update();
        return redirect()->back()->with('status-pro', 'Your Profile was Updated !');
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

        $user->role_as = Auth::user()->role_as;

        $user->update();
        return redirect()->back()->with('statuspic', 'Profile Image Updated !');
    }

    public function passwordupdate(Request $request)
    {
        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);

        $user->password = bcrypt($request->input('newpsw'));

        $user->role_as = Auth::user()->role_as;

        $user->update();
        Auth::logout();
        return redirect('/login')->with('status-password', 'Password Updated Successfully, Please Login again!');
    }

}

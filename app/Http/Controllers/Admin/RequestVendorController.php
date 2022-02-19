<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ConfirmvMailable;
use App\Models\Models\Request_vendor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RequestVendorController extends Controller
{
    public function index()
    {
        $req_all = Request_vendor::where('status',  '!=', '2')->where('confirm', '0')->orderByRaw('created_at DESC')->get();
        return view('admin.vendor-req.index')->with('req_all', $req_all);
    }

    public function confirm($id)
    {
        $reqv = Request_vendor::find($id);
        $reqv->status = "1";
        $reqv->update();
        return view('admin.vendor-req.confirm')->with('reqv', $reqv);
    }

    private function requestVendorMailable(Request $request, $id)
    {
        $vdata =
            [
                'vendor_name' => $request->input('vendor_name'),
                'description' => $request->input('description'),
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'created_at' => $request->input('created_at'),
                'id' => $id,
            ];

        $to_customer_email = $request->input('email');
        Mail::to($to_customer_email)->send(new ConfirmvMailable($vdata));
    }

    public function confirmed(Request $request, $id)
    {
        $req = Request_vendor::find($id);
        $req->confirm = "1";
        $req->update();

        $user_id = $req->user_id;
        $user = User::find($user_id);
        $user->role_as = 'vendor';
        $user->update();

        $vendor_name = $request->input('vendor_name');
        $description = $request->input('description');
        $name = $request->input('name');
        $email = $request->input('email');
        $created_at = $request->input('created_at');

        // Send Mail
        $this->requestVendorMailable($request, $id);

        return redirect()->back()->with('status-confirmed', 'This Vendor Request was Confirmed!');
    }
}

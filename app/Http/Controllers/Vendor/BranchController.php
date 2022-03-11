<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
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

    public function branchindex()
    {
        $user_id = Auth::user()->id;
        $branches = Branch::where('status', '!-', '1')->where('vendor_id', $user_id)->get(); // 0 = open, 1 = closed, 2 deleted

        return view('vendor.branch.index')->with('branches', $branches);
    }

    public function addbranch()
    {
        return view('vendor.branch.add');
    }

    public function storebranch(Request $request)
    {
        $branch = new Branch();
        $branch->vendor_id = Auth::user()->id;
        $branch->name = $request->input('name');
        $branch->country  = $request->input('country');
        $branch->city = $request->input('city');
        $branch->status = $request->input('status');

        $branch->save();
        return redirect()->back()->with('status', 'Branch Added Successfully');

    }

    public function edit($id)
    {
        $decrypted = $this->encrypt_decrypt('decrypt', $id);
        $branch = Branch::find($decrypted);
        return view('vendor.branch.edit')->with('branch', $branch);
    }

    public function update(Request $request, $id)
    {
        $branch = Branch::find($id);
        $branch->name = $request->input('name');
        $branch->country  = $request->input('country');
        $branch->city = $request->input('city');
        $branch->status = $request->input('status');

        $branch->update();
        return redirect()->back()->with('status', 'Branch updated Successfully');

    }
}

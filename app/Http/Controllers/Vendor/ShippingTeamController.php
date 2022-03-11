<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Models\Branch;
use App\Models\Models\DeliTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShippingTeamController extends Controller
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


    public function index()
    {
        $user_id = Auth::user()->id;
        $deliteams = DeliTeam::where('status', '!=', '2')->where('vendor_id', $user_id)->get(); // 0 = free, 1 = unavailable , 2 delete

        return view('vendor.deliteam.index')->with('deliteams', $deliteams);
    }

    public function addteam()
    {
        $user_id = Auth::user()->id;
        $branch = Branch::where('status', '!=', '1')->where('status', '!=', '2')->where('vendor_id', $user_id)->get(); // 0 = open, 1 = closed, 2 deleted
        return view('vendor.deliteam.add')->with('branch', $branch);
    }

    public function storeteam(Request $request)
    {
        $team = new DeliTeam();
        $team->vendor_id = Auth::user()->id;
        $team->branch_id = $request->input('branch_id');
        $team->name = $request->input('name');
        $team->email = $request->input('email');
        $team->phone = $request->input('phone');
        $team->schedule = $request->input('schedule');
        $team->status = $request->input('status');
        $team->save();
        return redirect()->back()->with('status', 'Shippinng Team added Successfully!');
    }

    public function edit($id)
    {
        $user_id = Auth::user()->id;
        $decrypted = $this->encrypt_decrypt('decrypt', $id);
        $branch = Branch::where('status', '!=', '1')->where('status', '!=', '2')->where('vendor_id', $user_id)->get();
        $team = DeliTeam::find($decrypted);
        return view('vendor.deliteam.edit')->with('team', $team)->with('branch', $branch);
    }

    public function update(Request $request, $id)
    {
        $team = DeliTeam::find($id);
        $team->branch_id = $request->input('branch_id');
        $team->name = $request->input('name');
        $team->email = $request->input('email');
        $team->phone = $request->input('phone');
        $team->schedule = $request->input('schedule');
        $team->status = $request->input('status');

        $team->update();
        return redirect()->back()->with('status', 'Shippinng Team updated Successfully!');

    }
}

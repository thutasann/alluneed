<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisteredController extends Controller
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

    public function index(Request $request)
    {
        $users_all = User::all();
        $users = User::where('role_as', $request->input('roles'))->get();
        return view('admin.users.index')->with('users', $users)
        ->with('users_all', $users_all);;
    }

    public function edit($id)
    {
        $decrypted = $this->encrypt_decrypt('decrypt', $id);
        $user_roles = User::find($decrypted);
        return view('admin.users.edit')->with('user_roles', $user_roles);
    }

    public function updaterole(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->role_as = $request->input('roles');
        $user->isban = $request->input('isban');
        $user->update();
        return redirect()->back()->with('status', 'Updated Successfully');
    }
}

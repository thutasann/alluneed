<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Models\Groups;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    //0=>show, 1=>hide, 2=>delete
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
        $group = Groups::where('status', '!=', '2')->get();
        $trash = Groups::where('status', '2')->get();
        return view('admin.collection.group.index')->with('group', $group)
            ->with('trash', $trash);
    }

    public function groupadd()
    {
        return view('admin.collection.group.create');
    }

    public function store(Request $request)
    {
        $group = new Groups();
        $group->url = $request->input('url');
        $group->name = $request->input('name');
        $group->descrip = $request->input('descrip');

        if ($request->input('status') == true) {
            $group->status = "1";
        } else {
            $group->status = "0";
        }

        $group->save();
        return redirect()->back()->with('status', 'Group Data Added Successfully');
    }

    public function edit($id)
    {
        $decrypted = $this->encrypt_decrypt('decrypt', $id);
        $group = Groups::find($decrypted);
        return view('admin.collection.group.edit')->with('group', $group);
    }

    public function update(Request $request, $id)
    {
        $group = Groups::find($id);
        $group->url = $request->input('url');
        $group->name = $request->input('name');
        $group->descrip = $request->input('descrip');
        $group->status = $request->input('status') == true ? '1' : '0';

        $group->update();
        return redirect()->back()->with('status', 'Group Data Updated Successfully');
    }

    public function delete($id)
    {
        $decrypted = $this->encrypt_decrypt('decrypt', $id);
        $group = Groups::find($decrypted);
        $group->status = "2";
        $group->update();
        return redirect()->back()->with('status', 'One group Moved to Trash!');
    }

    public function deletedrecords()
    {
        $group = Groups::where('status', '2')->get();
        return view('admin.collection.group.deleted')->with('group', $group);
    }

    public function deletedrestore($id)
    {
        $decrypted = $this->encrypt_decrypt('decrypt', $id);
        $group = Groups::find($decrypted);
        $group->status = "0"; //0=>show, 1=>hide, 2=>delete
        $group->update();
        return redirect('groups')->with('status', 'Group Data Restored Successfully');
    }

    public function deletetrash($id)
    {
        $decrypted = $this->encrypt_decrypt('decrypt', $id);
        $group = Groups::find($decrypted);
        $group->delete();
        return redirect()->back()->with('del-trash-status', 'Trash Deleted Successfully');

    }

    public function emptytrash()
    {
        $trash = Groups::where('status', '2');
        $trash->delete();
        return redirect()->back()->with('empty-trash-status', 'Empty Trash Successfully');

    }
}

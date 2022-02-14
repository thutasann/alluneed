<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Models\Groups;
use App\Models\Models\Category;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
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
        $category = Category::where('status', '!=', '3')->get();
        $trash = Category::where('status', '3')->get();
        return view('admin.collection.category.index')->with('category', $category)
            ->with('trash', $trash);
    }

    public function create()
    {
        $group = Groups::where('status', '!=', '2')->get(); //2 is deleted data for only group
        return view('admin.collection.category.create')->with('group', $group);
    }

    public function store(Request $request)
    {
        $category = new Category();
        $category->group_id = $request->input('group_id');
        $category->name = $request->input('name');
        $category->url = $request->input('url');
        $category->description = $request->input('description');

        if ($request->hasfile('category_img')) {
            $image_file = $request->file('category_img');
            $img_extension = $image_file->getClientOriginalExtension();
            $img_filename = time() . '.' . $img_extension;
            $image_file->move('uploads/categoryimage/', $img_filename);
            $category->image = $img_filename;
        }

        if ($request->hasfile('category_icon')) {

            $icon_file = $request->file('category_icon');
            $icon_extension = $icon_file->getClientOriginalExtension();
            $icon_filename = time() . '.' . $icon_extension;
            $icon_file->move('uploads/categoryicon/', $icon_filename);
            $category->icon = $icon_filename;
        }

        $category->status = $request->input('status') == true ? '1' : '0'; //0=show | 1:hide

        if ($request->hasfile('category_img') == '') {

            return redirect()->back()->with('status-img', 'Please Choose Image');
        } elseif ($request->hasfile('category_icon') == '') {

            return redirect()->back()->with('status-icon', 'Please Choose Icon');
        } else {
            $category->save();
            return redirect()->back()->with('status', 'Category Added Successfully');
        }
    }

    public function edit($id)
    {
        $group = Groups::where('status', '!=', '3')->get();
        $decrypted = $this->encrypt_decrypt('decrypt', $id);
        $category = Category::find($decrypted);
        return view('admin.collection.category.edit')->with('group', $group)
            ->with('category', $category);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->group_id = $request->input('group_id');
        $category->name = $request->input('name');
        $category->url = $request->input('url');
        $category->description = $request->input('description');

        if ($request->hasfile('category_img')) {
            $filepath_image = 'uploads/categoryimage/' . $category->image;

            if (File::exists($filepath_image)) {
                File::delete($filepath_image);
            }

            $image_file = $request->file('category_img');
            $img_extension = $image_file->getClientOriginalExtension();
            $img_filename = time() . '.' . $img_extension;
            $image_file->move('uploads/categoryimage/', $img_filename);
            $category->image = $img_filename;
        }

        if ($request->hasfile('category_icon')) {
            $filepath_icon = 'uploads/categoryicon/' . $category->icon;

            if (File::exists($filepath_icon)) {
                File::delete($filepath_icon);
            }

            $icon_file = $request->file('category_icon');
            $icon_extension = $icon_file->getClientOriginalExtension();
            $icon_filename = time() . '.' . $icon_extension;
            $icon_file->move('uploads/categoryicon/', $icon_filename);
            $category->icon = $icon_filename;
        }

        $category->status = $request->input('status') == true ? '1' : '0'; //0=show | 1:hide
        $category->update();

        return redirect()->back()->with('status', 'Category Updated Successfully');
    }

    public function delete($id)
    {
        $decrypted = $this->encrypt_decrypt('decrypt', $id);
        $category = Category::find($decrypted);
        $category->status = '3';
        $category->update();
        return redirect()->back()->with('status', 'One Category Moved to Trash!');
    }

    public function deletedrecords()
    {
        $category = Category::where('status', '3')->get();
        return view('admin.collection.category.deleted')->with('category', $category);
    }

    public function deletedrestore($id)
    {
        $decrypted = $this->encrypt_decrypt('decrypt', $id);
        $category = Category::find($decrypted);
        $category->status = "0";
        $category->update();
        return redirect('category')->with('status', 'Category Restored Successfully');
    }

    public function deletetrash($id)
    {
        $decrypted = $this->encrypt_decrypt('decrypt', $id);
        $category = Category::find($decrypted);
        $category->delete();
        return redirect()->back()->with('del-trash-status', 'Trash Deleted Successfully');
    }

    public function emptytrash()
    {
        $trash =  Category::where('status', '3');
        $trash->delete();
        return redirect()->back()->with('empty-trash-status', 'Empty Trash Successfully');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Models\Category;
use App\Models\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; // or use File;


class SubcategoryController extends Controller
{
    //3 is deleted data

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
        $subcategory = Subcategory::where('status', '!=', '3')->get();
        $trash = Subcategory::where('status', '3')->get();

        return view('admin.collection.subcategory.index')->with('subcategory', $subcategory)
            ->with('category', $category)
            ->with('trash', $trash);
    }

    public function create(Request $request)
    {
        $subcategory = new Subcategory();
        $subcategory->category_id = $request->input('category_id');
        $subcategory->name = $request->input('name');
        $subcategory->url = $request->input('url');
        $subcategory->description = $request->input('description');

        if ($request->hasfile('image')) {

            $image_file = $request->file('image');
            $img_extension = $image_file->getClientOriginalExtension();
            $img_filename = time() . '.' . $img_extension;
            $image_file->move('uploads/subcategoryimage/', $img_filename);
            $subcategory->image = $img_filename;
        }

        $subcategory->priority = $request->input('priority');
        $subcategory->status = $request->input('status') == true ? '1' : '0'; //0=show | 1:hide

        if ($request->hasfile('image') == '') {
            return redirect()->back()->with('status-img', 'Please Choose Image');
        } else {

            $subcategory->save();
            return redirect()->back()->with('status', 'Sub-Category Added Successfully');
        }
    }

    public function edit($id)
    {
        $category = Category::where('status', '!=', '3')->get();
        $decrypted = $this->encrypt_decrypt('decrypt', $id);
        $subcategory = Subcategory::find($decrypted);
        return view('admin.collection.subcategory.edit')->with('subcategory', $subcategory)
            ->with('category', $category);
    }

    public function update(Request $request, $id)
    {
        $subcategory = Subcategory::find($id);
        $subcategory->category_id = $request->input('category_id');
        $subcategory->name = $request->input('name');
        $subcategory->url = $request->input('url');
        $subcategory->description = $request->input('description');

        if ($request->hasfile('image')) {
            $filepath_image = 'uploads/subcategoryimage/' . $subcategory->image;
            if (File::exists($filepath_image)) {
                File::delete($filepath_image);
            }
            $image_file = $request->file('image');
            $img_extension = $image_file->getClientOriginalExtension();
            $img_filename = time() . '.' . $img_extension;
            $image_file->move('uploads/subcategoryimage/', $img_filename);
            $subcategory->image = $img_filename;
        }

        $subcategory->priority = $request->input('priority');
        $subcategory->status = $request->input('status') == true ? '1' : '0'; //0=show | 1:hide
        $subcategory->update();

        return redirect('sub-category')->with('status', 'Sub-Category Updated Successfully');
    }

    public function delete($id)
    {
        $decrypted = $this->encrypt_decrypt('decrypt', $id);
        $subcategory = Subcategory::find($decrypted);
        $subcategory->status = '3';
        $subcategory->update();
        return redirect()->back()->with('status', 'One SubCategory Moved to Trash');
    }

    public function deletedrecords()
    {
        $category = Category::where('status', '3')->get();
        $subcategory = Subcategory::where('status', '3')->get();

        return view('admin.collection.subcategory.deleted')->with('subcategory', $subcategory)
            ->with('category', $category);
    }

    public function deletedrestore($id)
    {
        $decrypted = $this->encrypt_decrypt('decrypt', $id);
        $subcategory = Subcategory::find($decrypted);
        $subcategory->status = "0";
        $subcategory->update();
        return redirect('sub-category')->with('status', 'Sub Category Restored Successfully');
    }

    public function deletetrash($id)
    {
        $decrypted = $this->encrypt_decrypt('decrypt', $id);
        $subcategory = Subcategory::find($decrypted);
        $subcategory->delete();
        return redirect()->back()->with('del-trash-status', 'Trash Deleted Successfully');
    }

    public function emptytrash()
    {
        $trash =  Subcategory::where('status', '3');
        $trash->delete();
        return redirect()->back()->with('empty-trash-status', 'Empty Trash Successfully');
    }
}

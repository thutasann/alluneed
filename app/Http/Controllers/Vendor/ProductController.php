<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Models\Products;
use App\Models\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    private function encrypt_decrypt($action, $string)
    {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_iv = 'This is my secret iv';
        $secret_key = '1f4276388ad3214c873428dbef42243f';
        $key = hash('sha256', $secret_key);
        $iv = substr(hash(
            'sha256',
            $secret_iv
        ), 0, 16);

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

        $subcategory = Subcategory::where('status', '!=', '3')->get();
        $products = Products::where('status', '!=', '3')->where('vendor_id', $user_id)->get();
        $trash = Products::where('status', '3')->where('vendor_id', $user_id)->get();

        return view('vendor.collection.product.index')->with('products', $products)
            ->with('subcategory', $subcategory)
            ->with('trash', $trash);
    }

    public function add()
    {
        $subcategory = Subcategory::where('status', '!=', '3')->get();
        return view('vendor.collection.product.create')->with('subcategory', $subcategory);
    }

    public function store(Request $request)
    {
        $products = new Products();
        $products->name = $request->input('name');
        $products->sub_category_id = $request->input('sub_category_id');
        $products->vendor_id = $request->input('vendor_id');
        $products->url = $request->input('url');
        $products->small_description = $request->input('small_description');

        if ($request->hasfile('prod_image')) {

            $image_file = $request->file('prod_image');
            $img_extension = $image_file->getClientOriginalExtension();
            $img_filename = time() . '.' . $img_extension;
            $image_file->move('uploads/products/prod', $img_filename);
            $products->prod_image = $img_filename;
        }

        if ($request->hasfile('prod_image_1')) {

            $image_file_1 = $request->file('prod_image_1');
            $img_extension_1 = $image_file_1->getClientOriginalExtension();
            $img_filename_1 = time() . '.' . $img_extension_1;
            $image_file_1->move('uploads/products/prod_1', $img_filename_1);
            $products->prod_image_1 = $img_filename_1;
        }

        if ($request->hasfile('prod_image_2')) {

            $image_file_2 = $request->file('prod_image_2');
            $img_extension_2 = $image_file_2->getClientOriginalExtension();
            $img_filename_2 = time() . '.' . $img_extension_2;
            $image_file_2->move('uploads/products/prod_2', $img_filename_2);
            $products->prod_image_2 = $img_filename_2;
        }

        if ($request->hasfile('prod_image_3')) {

            $image_file_3 = $request->file('prod_image_3');
            $img_extension_3 = $image_file_3->getClientOriginalExtension();
            $img_filename_3 = time() . '.' . $img_extension_3;
            $image_file_3->move('uploads/products/prod_3', $img_filename_3);
            $products->prod_image_3 = $img_filename_3;
        }

        $products->p_highlight_heading = $request->input('p_highlight_heading');
        $products->p_highlights = $request->input('p_highlights');
        $products->p_description_heading = $request->input('p_description_heading');
        $products->p_description = $request->input('p_description');
        $products->p_details_heading = $request->input('p_details_heading');
        $products->p_details = $request->input('p_details');

        $products->sale_tag = $request->input('sale_tag');
        $products->original_price = $request->input('original_price');
        $products->offer_price = $request->input('offer_price');
        $products->quantity = $request->input('quantity');
        $products->priority = $request->input('priority');

        $products->new_arrival = $request->input('new_arrival') == true ? '1' : '0';
        $products->featured_products = $request->input('featured_products') == true ? '1' : '0';
        $products->popular_products = $request->input('popular_products') == true ? '1' : '0';
        $products->offers_products = $request->input('offers_products') == true ? '1' : '0';
        $products->status = $request->input('status') == true ? '1' : '0';

        $products->meta_title = $request->input('meta_title');
        $products->meta_description = $request->input('meta_description');
        $products->meta_keyword = $request->input('meta_keyword');

        if ($request->input('name') == '') {
            return redirect()->back()->with('status_name', 'Please Entere Product Name');
        } else if ($request->input('url') == '') {
            return redirect()->back()->with('status_url', 'Please Enter Name to set URL');
        } else if ($request->input('sub_category_id') == '') {
            return redirect()->back()->with('status_brand', 'Please Choose Brand');
        } else if ($request->hasfile('prod_image') == '') {
            return redirect()->back()->with('status_img', 'Please Choose Image (1)');
        } else if ($request->hasfile('prod_image_1') == '') {
            return redirect()->back()->with('status_img_1', 'Please Choose Image (2)');
        } else if ($request->hasfile('prod_image_2') == '') {
            return redirect()->back()->with('status_img_2', 'Please Choose Image (3)');
        } else if ($request->hasfile('prod_image_3') == '') {
            return redirect()->back()->with('status_img_3', 'Please Choose Image (4)');
        } else if ($request->input('original_price') == '') {
            return redirect()->back()->with('status_orprice', 'Please Enter Original Price');
        } else if ($request->input('quantity') == '') {
            return redirect()->back()->with('status_qty', 'Please Enter Quantity');
        } else if ($request->input('priority') == '') {
            return redirect()->back()->with('status_priority', 'Please Enter Priority');
        } else if ($request->input('meta_title') == '') {
            return redirect()->back()->with('status_meta', 'Please Enter Meta Title');
        } else {
            $products->save();
            return redirect()->back()->with('status', 'Your Product was Uploaded Successfully');
        }
    }

    public function edit($id)
    {
        $decrypted = $this->encrypt_decrypt('decrypt', $id);
        $subcategory = Subcategory::where('status', '!=', '3')->get();
        $products = Products::find($decrypted);

        return view('vendor.collection.product.edit')->with('products', $products)
            ->with('subcategory', $subcategory);
    }

    public function update(Request $request, $id)
    {
        $products = Products::find($id);
        $products->name = $request->input('name');
        $products->sub_category_id = $request->input('sub_category_id');
        $products->url = $request->input('url');
        $products->small_description = $request->input('small_description');

        if ($request->hasfile('prod_image')) {
            $filepath_image = 'uploads/products/prod/' . $products->prod_image;
            if (File::exists($filepath_image)) {
                File::delete($filepath_image);
            }

            $image_file = $request->file('prod_image');
            $img_extension = $image_file->getClientOriginalExtension();
            $img_filename = time() . '.' . $img_extension;
            $image_file->move('uploads/products/prod/', $img_filename);
            $products->prod_image = $img_filename;
        }

        if ($request->hasfile('prod_image_1')) {
            $filepath_image_1 = 'uploads/products/prod_1/' . $products->prod_image_1;
            if (File::exists($filepath_image_1)) {
                File::delete($filepath_image_1);
            }

            $image_file_1 = $request->file('prod_image_1');
            $img_extension_1 = $image_file_1->getClientOriginalExtension();
            $img_filename_1 = time() . '.' . $img_extension_1;
            $image_file_1->move('uploads/products/prod_1/', $img_filename_1);
            $products->prod_image_1 = $img_filename_1;
        }

        if ($request->hasfile('prod_image_2')) {
            $filepath_image_2 = 'uploads/products/prod_2/' . $products->prod_image_2;
            if (File::exists($filepath_image_2)) {
                File::delete($filepath_image_2);
            }

            $image_file_2 = $request->file('prod_image_2');
            $img_extension_2 = $image_file_2->getClientOriginalExtension();
            $img_filename_2 = time() . '.' . $img_extension_2;
            $image_file_2->move('uploads/products/prod_2/', $img_filename_2);
            $products->prod_image_2 = $img_filename_2;
        }

        if ($request->hasfile('prod_image_3')) {
            $filepath_image_3 = 'uploads/products/prod_3/' . $products->prod_image_3;
            if (File::exists($filepath_image_3)) {
                File::delete($filepath_image_3);
            }

            $image_file_3 = $request->file('prod_image_3');
            $img_extension_3 = $image_file_3->getClientOriginalExtension();
            $img_filename_3 = time() . '.' . $img_extension_3;
            $image_file_3->move('uploads/products/prod_3/', $img_filename_3);
            $products->prod_image_3 = $img_filename_3;
        }

        $products->p_highlight_heading = $request->input('p_highlight_heading');
        $products->p_highlights = $request->input('p_highlights');
        $products->p_description_heading = $request->input('p_description_heading');
        $products->p_description = $request->input('p_description');
        $products->p_details_heading = $request->input('p_details_heading');
        $products->p_details = $request->input('p_details');

        $products->sale_tag = $request->input('sale_tag');
        $products->original_price = $request->input('original_price');
        $products->offer_price = $request->input('offer_price');
        $products->quantity = $request->input('quantity');
        $products->priority = $request->input('priority');

        $products->new_arrival = $request->input('new_arrival') == true ? '1' : '0';
        $products->featured_products = $request->input('featured_products') == true ? '1' : '0';
        $products->popular_products = $request->input('popular_products') == true ? '1' : '0';
        $products->offers_products = $request->input('offers_products') == true ? '1' : '0';
        $products->status = $request->input('status') == true ? '1' : '0';

        $products->meta_title = $request->input('meta_title');
        $products->meta_description = $request->input('meta_description');
        $products->meta_keyword = $request->input('meta_keyword');

        if ($request->input('name') == '') {
            return redirect()->back()->with('status_name', 'Please Entere Product Name');
        } else if ($request->input('url') == '') {
            return redirect()->back()->with('status_url', 'Please Enter Name to set URL');
        } else if ($request->input('sub_category_id') == '') {
            return redirect()->back()->with('status_brand', 'Please Choose Brand');
        } else if ($request->input('original_price') == '') {
            return redirect()->back()->with('status_orprice', 'Please Enter Original Price');
        } else if ($request->input('quantity') == '') {
            return redirect()->back()->with('status_qty', 'Please Enter Quantity');
        } else if ($request->input('priority') == '') {
            return redirect()->back()->with('status_priority', 'Please Enter Priority');
        } else if ($request->input('meta_title') == '') {
            return redirect()->back()->with('status_meta', 'Please Enter Meta Title');
        } else {
            $products->update();
            return redirect()->back()->with('status', 'Product Updated Successfully');
        }
    }

    public function delete($id)
    {
        $decrypted = $this->encrypt_decrypt('decrypt', $id);
        $product = Products::find($decrypted);
        $product->status = '3';
        $product->update();
        return redirect()->back()->with('status', 'One Product Moved to Trash');
    }

    public function deletedrecords()
    {
        $user_id = Auth::user()->id;

        $subcategory = Subcategory::where('status', '3')->get();
        $products = Products::where('status', '3')->where('vendor_id', $user_id)->get();

        return view('vendor.collection.product.deleted')->with('products', $products)
            ->with('subcategory', $subcategory);
    }

    public function deletedrestore($id)
    {
        $decrypted = $this->encrypt_decrypt('decrypt', $id);
        $product = Products::find($decrypted);
        $product->status = "0";
        $product->update();
        return redirect()->back()->with('restore-status', 'Product Restored Successfully');
    }

    public function deletetrash($id)
    {
        $decrypted = $this->encrypt_decrypt('decrypt', $id);
        $product = Products::find($decrypted);
        $product->delete();
        return redirect()->back()->with('del-trash-status', 'Trash Deleted Successfully');
    }

    public function emptytrash()
    {
        $user_id = Auth::user()->id;
        $trash =  Products::where('status', '3')->where('vendor_id', $user_id)->get();
        $trash->delete();
        return redirect()->back()->with('empty-trash-status', 'Empty Trash Successfully');
    }
}

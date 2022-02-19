<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Models\Products;
use App\Models\Models\Slider;
use App\Models\Models\SliderProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class AdController extends Controller
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
        $slider = Slider::where('vendor_id', $user_id)
            ->where('status', '0')
            ->where('status', '!=', '1')
            ->get();

        return view('vendor.ad.index')->with('slider', $slider);
    }

    public function create()
    {
        return view('vendor.ad.create');
    }

    public function store(Request $request)
    {
        $slider = new Slider;
        $slider->heading = $request->input('heading');
        $slider->vendor_id = $request->input('vendor_id');
        $slider->description = $request->input('description');
        $slider->link = $request->input('link');
        $slider->link_name = $request->input('link_name');

        if ($request->hasfile('slider_image')) {
            $file = $request->file('slider_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/slider/', $filename);
            $slider->image = $filename;
        }

        $slider->status = $request->input('status') == true ?  '1' : '0';
        $slider->save();

        return redirect()->back()->with('status', 'Your Ad was uploaded successfully !');
    }


    public function edit($id)
    {
        $decrypted = $this->encrypt_decrypt('decrypt', $id);
        $slider = Slider::find($decrypted);
        return view('vendor.ad.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $slider = Slider::find($id);
        $slider->heading = $request->input('heading');
        $slider->description = $request->input('description');
        $slider->link = $request->input('link');
        $slider->link_name = $request->input('link_name');

        if ($request->hasfile('slider_image')) {
            $destination = 'uploads/slider/' . $slider->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('slider_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/slider/', $filename);
            $slider->image = $filename;
        }

        $slider->status = $request->input('status') == true ?  '1' : '0';
        $slider->save();

        return redirect()->back()->with('status', 'Your Ad has been Updated Successfully !');
    }

    // ------------

    public function adprod($id)
    {
        $decrypted = $this->encrypt_decrypt('decrypt', $id);
        $slider = Slider::find($decrypted);

        $slider_prods = SliderProducts::where('slider_id', $decrypted)->get();

        $vendor_id = Auth::user()->id;
        $products = Products::where('status', '0')
        ->where('status', '!=', '1')
        ->where('status', '!=', '3')
        ->where('vendor_id', $vendor_id)
        ->orderByRaw('created_at DESC')
        ->get();

        return view('vendor.ad.adprod')->with('slider', $slider)
        ->with('slider_prods', $slider_prods)
        ->with('products', $products);
    }

    public function adprodstore(Request $request, $id)
    {
        $slider_prod = new SliderProducts;
        $slider_prod->slider_id = $id;
        $slider_prod->product_id = $request->input('product_id');
        $slider_prod->save();
        return redirect()->back()->with('status', 'Product was added successfully !');
    }

}

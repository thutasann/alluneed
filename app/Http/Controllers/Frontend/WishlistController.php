<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Models\Wishlist;

class WishlistController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            $wishlist = Wishlist::all();
            return view('frontend.wishlist.index', compact('wishlist'));
        } else {
            return redirect()->route('login')->with('pls-login-wish', 'Please Login First');
        }
    }

    public function storewishlist(Request $request)
    {

        $product_id = $request->product_id;

        if (Wishlist::where('user_id', Auth::user()->id)->where('product_id', $product_id)->exists()) {
            return response()->json(['status' => "Product is already added to Wishlist"]);
        } else {
            $wishlist = new Wishlist();
            $wishlist->user_id = Auth::user()->id;
            $wishlist->product_id = $product_id;
            $wishlist->save();
            return response()->json(['status' => "Product is Added to Wishlist"]);
        }
    }

    public function removewishlist(Request $request)
    {
        $wishlist_id = $request->wishlist_id;
        if (Wishlist::where('user_id', Auth::user()->id)->where('id', $wishlist_id)->exists()) {
            $wishlist = Wishlist::where('user_id', Auth::user()->id)->where('id', $wishlist_id)->first();
            $wishlist->delete();
            return response()->json(['status' => "Item removed from the wishlist"]);
        } else {
            return response()->json(['status' => "No item found in the wishlist"]);
        }
    }
}

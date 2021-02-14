<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Crypt;



class CartController extends Controller
{

    public function index()
    {
        if (Auth::user()) {
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);

            // return $cart_data;

            $user_id = Auth::user()->id;

            $recent_prod = ActivityLog::where('status', '!=', '1')
                ->where('user_id', $user_id)
                ->where('type', 'view detail')
                ->orderByRaw('created_at DESC')
                ->limit(10)
                ->get();


            return view('frontend.cart.index')->with('cart_data', $cart_data)
                ->with('recent_prod', $recent_prod);
        } else {
            return redirect()->route('login')->with('pls-login', 'Please Login First');
        }
    }

    public function addtocart(Request $request)
    {
        $prod_id = $request->input('product_id');
        $quantity = $request->input('quantity');

        if (Cookie::get('shopping_cart')) {
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);
        } else {
            $cart_data = array();
        }

        $item_id_list = array_column($cart_data, 'item_id');
        $prod_id_is_there = $prod_id;

        if (in_array($prod_id_is_there, $item_id_list)) {
            foreach ($cart_data as $keys => $values) {
                if ($cart_data[$keys]["item_id"] == $prod_id) {
                    $cart_data[$keys]["item_quantity"] = $request->input('quantity');
                    $item_data = json_encode($cart_data);

                    $minutes = 60;
                    Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                    return response()->json(['status' => '"' . $cart_data[$keys]["item_name"] . '" Already Added to Cart']);
                }
            }
        } else {

            $products = Products::find($prod_id);
            $prod_name = $products->name;
            $prod_image = $products->prod_image;
            $priceval = $products->offer_price;

            if ($products) {
                $item_array = array(
                    'item_id' => $prod_id,
                    'item_name' => $prod_name,
                    'item_quantity' => $quantity,
                    'item_price' => $priceval,
                    'item_image' => $prod_image
                );
                $cart_data[] = $item_array;

                $item_data = json_encode($cart_data);
                $minutes = 60;

                Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                return response()->json(['status' => '"' . $prod_name . '" Added to Cart']);
            }
        }
    }

    public function updatetocart(Request $request)
    {
        $prod_id = $request->input('product_id');
        $quantity = $request->input('quantity');

        if (Cookie::get('shopping_cart')) {
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);

            $item_id_list = array_column($cart_data, 'item_id');
            $prod_id_is_there = $prod_id;

            if (in_array($prod_id_is_there, $item_id_list)) {
                foreach ($cart_data as $keys => $values) {
                    if ($cart_data[$keys]["item_id"] == $prod_id) {
                        $cart_data[$keys]["item_quantity"] =  $quantity;
                        $ttprice = ($cart_data[$keys]["item_price"] * $quantity);
                        $grandtotalprice = number_format($ttprice, 2);
                        $item_data = json_encode($cart_data);

                        $minutes = 60;
                        Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                        return response()->json([
                            'status' => '"' . $cart_data[$keys]["item_name"] . '" Quantity Updated',
                            'gtprice' => '' . $grandtotalprice . ''
                        ]);
                    }
                }
            }
        }
    }

    public function cartloadbyajax()
    {
        if (Cookie::get('shopping_cart')) {
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);
            $totalcart = count($cart_data);

            echo json_encode(array('totalcart' => $totalcart));
            die;
            return;
        } else {
            $totalcart = "0";
            echo json_encode(array('totalcart' => $totalcart));
            die;
            return;
        }
    }

    public function deletefromcart(Request $request)
    {
        $prod_id = $request->input('product_id');

        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $cart_data = json_decode($cookie_data, true);

        $item_id_list = array_column($cart_data, 'item_id');
        $prod_id_is_there = $prod_id;

        if (in_array($prod_id_is_there, $item_id_list)) {
            foreach ($cart_data as $keys => $values) {
                if ($cart_data[$keys]["item_id"] == $prod_id) {
                    unset($cart_data[$keys]);
                    $item_data = json_encode($cart_data);
                    $minutes = 60;
                    Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                    return response()->json(['status' => 'Item Removed from Cart']);
                }
            }
        }
    }

    public function clearcart()
    {
        Cookie::queue(Cookie::forget('shopping_cart'));
        return response()->json(['status' => 'Your Cart is Cleared']);
    }

    public function thankyou()
    {
        return view('frontend.thank-you');
    }

    public function SearchautoComplete(Request $request)
    {
        $query = $request->get('term', '');
        $products = Products::where('name', 'LIKE', '%' . $query . '%')->where('status', '0')->get();

        $data = [];
        foreach ($products as $items) {
            $data[] = [
                'id' => $items->id,
                'value' => $items->name,
            ];
        }
        if (count($data)) {
            return $data;
        } else {
            return ['value' => 'No resule found', 'id' => ''];
        }
    }

    public function result(Request $request)
    {
        $serachingdata = $request->input('search_product');
        $products = Products::where('name', 'LIKE', '%' . $serachingdata . '%')->where('status', '!=', '2')->where('status', '0')->first();


        if ($products) {

            $product_id = $products->id;
            $encrypt_id = Crypt::encrypt($product_id);
            // return $products->url;


            if (isset($_POST['searchbtn'])) {
                return redirect('collection/' . $products->subcategory->category->group->url . '/' .
                    $products->subcategory->category->url . '/' . $products->subcategory->url);
            } else {
                return redirect('collection/' . $products->subcategory->category->group->url . '/' .
                    $products->subcategory->category->url . '/' . $products->subcategory->url . '/' . $products->url . '/' . $encrypt_id);
            }
            // return redirect('search/'.$products->url);
        } else {
            return redirect('/')->with('status-no-search', 'Product Not found');
        }
    }
}

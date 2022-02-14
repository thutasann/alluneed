<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Models\Category;
use App\Models\Models\Groups;
use App\Models\Models\Like;
use App\Models\Models\Products;
use App\Models\Models\Review;
use App\Models\Models\Subcategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class CollectionController extends Controller
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


    public function homeindex()
    {
        $groups = Groups::where('status', '0')
        ->where('status', '!=', '1')
        ->where('status', '!=', '2')
        ->limit(12)
            ->get();

        $categories = Category::where('status', '0')
        ->where('status', '!=', '1')
        ->where('status', '!=', '3')
        ->limit(6)
            ->get();

        $products = Products::where('status', '0')
        ->where('status', '!=', '1')
        ->where('status', '!=', '3')
        ->orderByRaw('created_at DESC')
        ->get();

        $newarrivals = Products::where('status', '0')
        ->where('status', '!=', '1')
        ->where('status', '!=', '3')
        ->where('new_arrival', '1')
        ->orderBy('created_at', 'DESC')
            ->limit(6)
            ->get();

        $popular = Products::where('status', '0')
        ->where('status', '!=', '1')
        ->where('status', '!=', '3')
        ->where('popular_products', '1')
        ->orderBy('created_at', 'DESC')
            ->get();


        $users = User::where('role_as', 'vendor')
        ->where('isban', '0')->get();

        return view('frontend.index')->with('groups', $groups)
            ->with('categories', $categories)
            ->with('products', $products)
            ->with('newarrivals', $newarrivals)
            ->with('popular', $popular)
            ->with('users', $users);
    }

    public function newarrivals()
    {
        $newarrivals = Products::where('status', '0')
            ->where('status', '!=', '1')
            ->where('status', '!=', '3')
            ->where('new_arrival', '1')
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('frontend.newarrivals.index')->with('newarrivals', $newarrivals);
    }

    public function sellers()
    {
        $sellers = User::where('role_as', 'vendor')
        ->where('isban', '0')->get();

        return view('frontend.sellers.index')->with('sellers', $sellers);
    }

    public function index()
    {
        $groups = Groups::where('status', '0')
            ->where('status', '!=', '1')
            ->where('status', '!=', '2')
            ->get();
        return view('frontend.collections.index')->with('groups', $groups);
    }

    public function groupview($group_url)
    {
        $group = Groups::where('url', $group_url)->first();
        $group_id = $group->id;
        $category = Category::where('group_id', $group_id)
            ->where('status', '0')
            ->where('status', '!=', '2')
            ->where('status', '!=', '3')
            ->get();
        return view('frontend.collections.category')
        ->with('category', $category)
            ->with('group', $group);
    }

    public function categoryview($group_url, $cate_url)
    {

        $category = Category::where('url', $cate_url)->first();
        $category_id = $category->id;
        $subcategory = Subcategory::where('category_id', $category_id)
            ->where('status', '0')
            ->where('status', '!=', '1')
            ->where('status', '!=', '3')
            ->get();
        return view('frontend.collections.sub-category')
        ->with('category', $category)
            ->with('subcategory', $subcategory);
    }

    public function subcategoryview($group_url, $cate_url, $subcate_url, Request $request)
    {
        $subcategory = Subcategory::where('url', $subcate_url)->first();
        $subcategory_id = $subcategory->id;
        $category_id = $subcategory->category_id;

        $subcategorylist = Subcategory::where('category_id', $category_id)->get();

        if ($request->get('sort') == 'price_asc') {
            $products = Products::where('sub_category_id', $subcategory_id)
                ->orderBy('offer_price', 'asc')
                ->where('status', '!=', '1')
                ->where('status', '!=', '3')
                ->where('status', '0')->get();
        } elseif ($request->get('sort') == 'price_desc') {
            $products = Products::where('sub_category_id', $subcategory_id)
                ->orderBy('offer_price', 'desc')
                ->where('status', '!=', '1')
                ->where('status', '!=', '3')
                ->where('status', '0')->get();
        } elseif ($request->get('sort') == 'newest') {
            $products = Products::where('sub_category_id', $subcategory_id)
                ->orderBy('created_at', 'desc')
                ->where('status', '!=', '1')
                ->where('status', '!=', '3')
                ->where('status', '0')->get();
        } elseif ($request->get('sort') == 'popularity') {
            $products = Products::where('sub_category_id', $subcategory_id)
                ->where('popular_products', '1')
                ->where('status', '!=', '1')
                ->where('status', '!=', '3')
                ->where('status', '0')->get();
        } elseif ($request->get('prod_tag') == 'new_arrival') {
            $products = Products::where('sub_category_id', $subcategory_id)
                ->where('new_arrival', '1')
                ->where('status', '!=', '1')
                ->where('status', '!=', '3')
                ->where('status', '0')->get();
        } elseif ($request->get('prod_tag') == 'featured_products') {
            $products = Products::where('sub_category_id', $subcategory_id)
                ->where('featured_products', '1')
                ->where('status', '!=', '1')
                ->where('status', '!=', '3')
                ->where('status', '0')->get();
        } elseif ($request->get('prod_tag') == 'popular_products') {
            $products = Products::where('sub_category_id', $subcategory_id)
                ->where('popular_products', '1')
                ->where('status', '!=', '1')
                ->where('status', '!=', '3')
                ->where('status', '0')->get();
        } elseif ($request->get('prod_tag') == 'offers_products') {
            $products = Products::where('sub_category_id', $subcategory_id)
                ->where('offers_products', '1')
                ->where('status', '!=', '1')
                ->where('status', '!=', '3')
                ->where('status', '0')->get();
        } elseif ($request->get('filterbrand')) {

            $checked = $_GET['filterbrand'];
            // filter with name
            $subcategory_filter = Subcategory::where('name', $checked)->get();
            $subcateid = [];
            foreach ($subcategory_filter as $scid_list) {
                array_push($subcateid, $scid_list->id);
            }
            // End - filter with name
            $products = Products::where('sub_category_id', $subcateid)->where('status', '0')->get();
        } else {
            $products = Products::where('sub_category_id', $subcategory_id)
                ->where('status', '0')
                ->where('status', '!=', '1')
                ->where('status', '!=', '3')
                ->orderByRaw('created_at DESC')
                ->get();
        }

        // own
        if (isset($_GET["q"])) {

            $prodsearch = $_GET["q"];
            $products = Products::where('sub_category_id', $subcategory_id)
                ->where('name', 'like', '%' . $prodsearch . '%')
                ->where('status', '0')
                ->where('status', '!=', '1')
                ->where('status', '!=', '3')
                ->get();
        }

        return view('frontend.collections.products')
            ->with('products', $products)
            ->with('subcategory', $subcategory)
            ->with('subcategorylist', $subcategorylist);
    }

    public function productview($group_url, $cate_url, $subcate_url, $prod_url, $prod_id)
    {
        if (Auth::user()) {
            $d_prod_id = Crypt::decrypt($prod_id);

            $review = Review::where('prod_id', $d_prod_id)
                ->orderByRaw('created_at DESC')
                ->get();

            $products = Products::where('url', $prod_url)
                ->where('status', '!=', '1')
                ->where('status', '!=', '3')
                ->where('status', '0')->first();

            $recom_subid = $products->subcategory->id;
            $recom_prod = Products::where('sub_category_id', $recom_subid)
                ->where('url', '!=', $prod_url)
                ->where('status', '!=', '1')
                ->where('status', '!=', '3')
                ->where('status', '0')
                ->get();

            $like = Like::where('prod_id', $d_prod_id)->get();

            $likecount = Like::where('prod_id', $d_prod_id)
                ->where('user_id', Auth::user()->id)
                ->get();


            $countlike = Like::where('prod_id', $d_prod_id)->get();

            $reactors = Like::where('prod_id', $d_prod_id)
                ->orderByRaw('created_at DESC')
                ->get();

            // Activity log ---
            // $user_id = Auth::user()->id;
            // $activities = new ActivityLog();
            // $activities->user_id = $user_id;
            // $activities->prod_id = $d_prod_id;
            // $activities->type = 'view detail';
            // $activities->save();
            // Activity log ---

            return view('frontend.collections.products-view')->with('products', $products)
                ->with('recom_prod', $recom_prod)
                ->with('review', $review)
                ->with('like', $like)
                ->with('likecount', $likecount)
                ->with('countlike', $countlike)
                ->with('reactors', $reactors);
        } else {
            return redirect()->route('login')->with('pls-login', 'Please Login First');
        }
    }


    // Serach autofill
    public function SearchautoComplete(Request $request)
    {
        $query = $request->get('term', '');
        $products = Products::where('name', 'LIKE', '%' . $query . '%')
            ->where('status', '0')
            ->where('status', '!=', '1')
            ->where('status', '!=', '3')
            ->get();

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
        $products = Products::where('name', 'LIKE', '%' . $serachingdata . '%')
            ->where('status', '!=', '1')
            ->where('status', '!=', '3')
            ->where('status', '0')->first();

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

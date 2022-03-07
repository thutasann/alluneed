<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\PlaceorderMailable;
use App\Models\Models\Coupon;
use App\Models\Models\Order;
use App\Models\Models\Orderitem;
use App\Models\Models\Products;
use App\Models\User;
use Carbon\Carbon;
// use Illuminate\Support\Carbon;

use Stripe\Charge;
use Stripe\Stripe;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;



class CheckoutController extends Controller
{
    public function index()
    {
        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $cart_data = json_decode($cookie_data, true);
        return view('frontend.checkout.index')->with('cart_data', $cart_data);
    }

    // private functions ----------------------------------


    // Check the coupon amount
    public function checkingcoupon(Request $request)
    {
        $couponcode = $request->input('coupon_code');

        if (Coupon::where('coupon_code', $couponcode)->exists()) {
            $coupon = Coupon::where('coupon_code', $couponcode)->first();

            if ($coupon->start_datetime <= Carbon::today()->format('Y-m-d') || Carbon::today()->format('Y-m-d') <= $coupon->end_datetime) {

                $totalprice = "0";
                $cookie_data = stripslashes(Cookie::get('shopping_cart'));
                $cart_data = json_decode($cookie_data, true);
                foreach ($cart_data as $itemdata) {
                    $products = Products::find($itemdata['item_id']);
                    $prod_price = $products->offer_price;
                    // $prod_price_with_tax = ($prod_price * $products->tax_amt) / 100; //Tax, Vat, GST
                    $totalprice = $totalprice + ($itemdata["item_quantity"] * $prod_price);
                }

                if ($coupon->coupon_type == "1") { // percentage
                    $discount_price = ($totalprice / 100) * $coupon->coupon_price;
                } elseif ($coupon->coupon_type == "2") { // amount
                    $discount_price = $coupon->coupon_price;
                }

                $grand_total = $totalprice - $discount_price;

                return response()->json([
                    'discount_price' => $discount_price,
                    'grand_total_price' => $grand_total,
                ]);
            } else {
                return response()->json([
                    'status' => 'Coupon code has been expired',
                    'error_status' => 'error'
                ]);
            }
        } else {
            return response()->json([
                'status' => 'Coupon code does not exists',
                'error_status' => 'error'
            ]);
        }
    }

    // Update user in Place order
    private function update_user($user_id, Request $request)
    {
        $user = User::find($user_id);

        $user->name = $request->input('fname');
        $user->lname = $request->input('Iname');
        $user->phone = $request->input('phone');
        $user->alternate_phone = $request->input('alternate_phone');
        $user->address1 = $request->input('address1');
        $user->address2 = $request->input('address2');
        $user->city = $request->input('city');
        $user->state = $request->input('state');
        $user->pincode = $request->input('pincode');
        return $user->save();
    }

    // Update user Stripe payment
    private function update_user_stripe($user_id, Request $request)
    {
        $user = User::find($user_id);

        $user->name = $request->input('s_fname');
        $user->lname = $request->input('s_Iname');
        $user->phone = $request->input('s_phone');
        $user->alternate_phone = $request->input('s_alternate_phone');
        $user->address1 = $request->input('s_address1');
        $user->address2 = $request->input('s_address2');
        $user->city = $request->input('s_city');
        $user->state = $request->input('s_state');
        $user->pincode = $request->input('s_pincode');
        return $user->save();
    }

    // Insert Order items
    private function insert_orderitem($last_order_id)
    {
        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $cart_data = json_decode($cookie_data, true);
        $items_in_cart = $cart_data;

        foreach ($items_in_cart as $itemdata) {
            $products = Products::find($itemdata['item_id']);
            $price_value = $products->offer_price;
            $tax_amt = $products->tax_amt;

            Orderitem::create([
                'order_id' => $last_order_id,
                'product_id' => $itemdata['item_id'],
                'vendor_id' => $itemdata['vendor_id'],
                'price' => $price_value,
                'tax_amt' => $tax_amt,
                'quantity' => $itemdata['item_quantity'],
            ]);
        }
    }

    // Place order mailable
    private function placeorderMailable(Request $request, $trackingno)
    {
        $orderdata =
            [
                'first_name' => $request->input('fname'),
                'last_name' => $request->input('Iname'),
                'phone_no' => $request->input('phone'),
                'alter_no' => $request->input('alternate_phone'),
                'address1' => $request->input('address1'),
                'address2' => $request->input('address2'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'pincode' => $request->input('pincode'),
                'email' => $request->input('email'),
                'trackingno' => $trackingno,
            ];

        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $items_in_cart = json_decode($cookie_data, true);

        $to_customer_email = $request->input('email');
        Mail::to($to_customer_email)->send(new PlaceorderMailable($orderdata, $items_in_cart));
    }

    // Place Order Mail (Stripe)
    private function placeorderMailable_stripe(Request $request, $trackingno)
    {
        $orderdata =
            [
                'first_name' => $request->input('s_fname'),
                'last_name' => $request->input('s_Iname'),
                'phone_no' => $request->input('s_phone'),
                'alter_no' => $request->input('s_alternate_phone'),
                'address1' => $request->input('s_address1'),
                'address2' => $request->input('s_address2'),
                'city' => $request->input('s_city'),
                'state' => $request->input('s_state'),
                'pincode' => $request->input('s_pincode'),
                'email' => $request->input('s_email'),
                'trackingno' => $trackingno,
            ];

        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $items_in_cart = json_decode($cookie_data, true);

        $to_customer_email = $request->input('s_email');
        Mail::to($to_customer_email)->send(new PlaceorderMailable($orderdata, $items_in_cart));
    }

    // private functions ----------------------------------

    public function storeorder(Request $request)
    {
        /*
            payment_status = 0 = Nothing paid, 1 = Cash paid, 2 = Razorpay payment successful, 3 = Razorpay payment failed, 4 =  pay, stripe.
        */

        if (isset($_POST['place_order_btn'])) {
            // User Data update
            $user_id = Auth::user()->id;
            $this->update_user($user_id, $request);


            //  Placing Orders
            $trackno = rand(1111, 9999);
            $order = new Order();
            $order->user_id = $user_id;
            $order->tracking_no = 'alluneed' . $trackno;
            $order->payment_mode = "Cash on Delivery";
            $order->payment_status = "0";
            $order->order_status = "0";
            $order->notify = "0";
            $order->save();
            $trackingno = $order->tracking_no;


            // Ordered cart items
            $last_order_id = $order->id;
            $this->insert_orderitem($last_order_id);

            // Send Mail
            $this->placeorderMailable($request, $trackingno);

            Cookie::queue(Cookie::forget('shopping_cart'));
            return redirect('/thank-you')->with('status', 'Order has been placed successfully');
        }

        if (isset($_POST['place_order_razorpay'])) {
            // User Data update
            $user_id = Auth::user()->id;
            $this->update_user($user_id, $request);


            //  Placing Orders
            $trackno = rand(1111, 9999);
            $order = new Order;
            $order->user_id = $user_id;
            $order->tracking_no = 'alluneed' . $trackno;
            $order->payment_mode = "Payment by Razorpay";
            $order->payment_id = $request->input('razorpay_payment_id');
            $order->payment_status = "2";
            $order->order_status = "0";
            $order->notify = "0";
            $order->save();
            $trackingno = $order->tracking_no;


            // Ordered cart items
            $last_order_id = $order->id;
            $this->insert_orderitem($last_order_id);

            // Send Mail
            $this->placeorderMailable($request, $trackingno);


            Cookie::queue(Cookie::forget('shopping_cart'));
            return redirect('/thank-you')->with('status', 'Order has been placed successfully');
        }
    }

    public function storeorderstripe(Request $request)
    {
        if (isset($_POST['stipe_payment_btn'])) {

            // User Data update
            $user_id = Auth::user()->id;
            $this->update_user_stripe($user_id, $request);

            // Stripe Data
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);
            $items_in_cart = $cart_data;

            $total = "0";
            foreach ($items_in_cart as $itemdata) {
                $products = Products::find($itemdata['item_id']);
                $pric_value = $products->offer_price;
                $total = $total + ($itemdata["item_quantity"] * $pric_value);
            }

            $stripetoken = $request->input('stripeToken');
            $STRIPE_SECRET = "sk_test_51I9OesBKw5M31KCuVupFzJ59umRqShw51ZAijutC5OThwpsCJ8YlbxjpKPzZLGeU1qQdkEsjAKrsuTb14vwzxRyx00nrO81Zhs";

            Stripe::setApiKey($STRIPE_SECRET);
            \Stripe\Charge::create([
                'amount' => $total * 100,
                'currency' => 'usd',
                'description' => "Thank you for ordering items with AllUNeed",
                'source' => $stripetoken,
                'shipping' =>
                [
                    'name' => Auth::user()->name,
                    'phone' => Auth::user()->phone,
                    'address' => [
                        'line1' => Auth::user()->address1,
                        'line2' => Auth::user()->address2,
                        'postal_code' => Auth::user()->pincode,
                        'city' => "Yangon",
                        'state' => "Yangon",
                        'country' => "Myanmar",
                    ],
                ],
            ]);


            //  Placing Orders
            $trackno = rand(1111, 9999);
            $order = new Order;
            $order->user_id = $user_id;
            $order->tracking_no = 'alluneed' . $trackno;
            $order->payment_mode = "Payment by Stripe";
            $order->payment_id = $stripetoken;
            $order->payment_status = "4";
            $order->order_status = "0";
            $order->notify = "0";
            $order->save();

            $trackingno = $order->tracking_no;

            // Ordered cart items
            $last_order_id = $order->id;
            $this->insert_orderitem($last_order_id);

            // Send Mail
            $this->placeorderMailable_stripe($request, $trackingno);

            Cookie::queue(Cookie::forget('shopping_cart'));
            return redirect('/thank-you')->with('status', 'Order has been placed successfully');
        }
    }


    // Check amount Razor
    public function checkamount(Request $request)
    {
        if (Cookie::get('shopping_cart')) {
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);
            $items_in_cart = $cart_data;

            $total = "0";
            foreach ($items_in_cart as $itemdata) {
                $products = Products::find($itemdata['item_id']);
                $pric_value = $products->offer_price;
                $total = $total + ($itemdata["item_quantity"] * $pric_value);
            }

            return response()->json([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone_no' => $request->phone_no,
                'alter_no' => $request->alter_no,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'city' => $request->city,
                'state' => $request->state,
                'pincode' => $request->pincode,
                'email' => $request->email,
                'total_price' => $total
            ]);
        } else {
            return response()->json([
                'status_code' => 'no_data_in_Cart',
                'status' => 'Your Cart in Empty',

            ]);
        }
    }

}

<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Models\Products;
use App\Models\Models\Slider;
use App\Models\Models\Coupon;
use App\Models\Models\DeliTeam;
use App\Models\Models\Order;
use App\Models\Models\Orderitem;
use App\Models\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class VendorDashboardController extends Controller
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

    // Vendor Dashboard
    public function index()
    {
        $user_id = Auth::user()->id;

        $products = Products::where('vendor_id', $user_id)
            ->where('status', '!=', '3')
            ->get();

        $sliders = Slider::where('vendor_id', $user_id)
            ->get();

        $coupons = Coupon::where('vendor_id', $user_id)
            ->get();

        $orderitems = OrderItem::where('vendor_id', $user_id)->get();

        return view('vendor.dashboard')->with('products', $products)
            ->with('sliders', $sliders)
            ->with('coupons', $coupons)
            ->with('orderitems', $orderitems);
    }

    // Customers
    public function customers()
    {
        $vendor_id = Auth::user()->id;
        $orderitems = OrderItem::where('vendor_id', $vendor_id)->get();
        return view('vendor.customers.index')->with('orderitems', $orderitems);
    }

    public function orders()
    {
        $vendor_id = Auth::user()->id;
        $orderitems = OrderItem::where('vendor_id', $vendor_id)->get();
        return view('vendor.orders.index')->with('orderitems', $orderitems);
    }

    public function vieworder($order_id)
    {
        $decrypted = $this->encrypt_decrypt('decrypt', $order_id);
        if (Order::where('id', $decrypted)->exists()) {
            $order = Order::find($decrypted);
            return view('vendor.orders.view', compact('order'));
        } else {
            return redirect()->back()->with('status', 'No Order Found');
        }
    }

    public function generateinvoice($order_id)
    {
        $decrypted = $this->encrypt_decrypt('decrypt', $order_id);
        if (Order::where('id', $decrypted)->exists()) {
            $orders = Order::find($decrypted);
            $data = [
                'orders' => $orders,
            ];
            // return view('vendor.orders.invoice', compact('orders'));
            $pdf = PDF::loadView('vendor.orders.invoice', $data);
            return $pdf->download('alluneed.pdf');
        } else {
            return redirect()->back()->with('status', 'No Order Found');
        }
    }


    public function proceedorder($order_id)
    {
        $decrypted = $this->encrypt_decrypt('decrypt', $order_id);

        if (Order::where('id', $decrypted)->exists()) {

            $user_id = Auth::user()->id;
            $deliteams = DeliTeam::where('status', '!=', '2')->where('vendor_id', $user_id)->get(); // 0 = free, 1 = unavailable , 2 delete
            $orders = Order::find($decrypted);
            return view('vendor.orders.proceed')->with('orders', $orders)->with('deliteams', $deliteams);

        } else {
            return redirect()->back()->with('status', 'No Order Found');
        }
    }

    public function trackingstatus(Request $request, $order_id)
    {
        $decrypted = $this->encrypt_decrypt('decrypt', $order_id);
        $orders = Order::find($decrypted);
        if ($orders->order_status != "2") {
            $orders->tracking_msg = $request->input('tracking_msg');
            $orders->update();
            return redirect()->back()->with('status', 'Tracking Msg Status Updated');
        } else {
            return redirect()->back()->with('status', 'Order is already Cancelled');
        }
    }


    public function cancelorder(Request $request, $order_id)
    {
        $decrypted = $this->encrypt_decrypt('decrypt', $order_id);
        $orders = Order::find($decrypted);
        if ($orders->tracking_msg != NULL) {
            $orders->cancel_reason = $request->input('cancel_reason');
            $orders->tracking_msg = "Cancelled when " . $orders->tracking_msg;
            $orders->order_status = "2";
            $orders->update();
            return redirect()->back()->with('status', 'Order was Cancelled');
        } else {
            return redirect()->back()->with('status', 'Update your tracking Status First');
        }
    }

    public function completeorder(Request $request, $order_id)
    {
        $decrypted = $this->encrypt_decrypt('decrypt', $order_id);
        $orders = Order::find($decrypted);
        if ($orders->tracking_msg != NULL) {
            if ($orders->order_status != "2") {
                $orders->tracking_msg = "Completed when " . $orders->tracking_msg;
                if ($orders->payment_status == "0") {
                    $orders->payment_status = $request->input('cash_received') == TRUE ? '1' : '0';
                }
                $orders->order_status = "1";
                $orders->update();
                return redirect()->back()->with('status', 'Order Completed successfully!');
            } else {
                return redirect()->back()->with('status', 'Your Order was Cancelled!');
            }
        } else {
            return redirect()->back()->with('status', 'Update your tracking status First');
        }
    }

    public function proceedshipping(Request $request, $id)
    {

        // shipping status => 0 = default, 1 = on shipping, 2 = received

        $vendor_id = Auth::user()->id;
        $order_id = $id;
        $tracking_no = rand(1111, 9999);

        $shipping = new Shipping();
        $shipping->shipping_tracking_no = 'aun_shipping'. $tracking_no;
        $shipping->shipping_date = $request->input('shipping_date');
        $shipping->vendor_id = $vendor_id;
        $shipping->team_id = $request->input('team_id');
        $shipping->order_id = $order_id;

        $shipping->update();

        $deliteam = DeliTeam::find($request->input('team_id'));
        $deliteam->status = 1;
        $deliteam->update();

        $order = Order::find($order_id);
        $order->order_status = 3; // proceeded shipping
        $order->update();

        return redirect()->back()->with('status', 'Shipping was proceeded succcessfully!');

    }


}

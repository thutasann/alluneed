<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use PDF;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('admin.order.index', compact('orders'));
    }

    public function vieworder($order_id)
    {
        if (Order::where('id', $order_id)->exists()) {
            $orders = Order::find($order_id);
            return view('admin.order.view', compact('orders'));
        } else {
            return redirect()->back()->with('status', 'No Order Found');
        }
    }

    public function generateinvoice($order_id)
    {

        if (Order::where('id', $order_id)->exists()) {
            $orders = Order::find($order_id);
            $data = [
                'orders' => $orders,
            ];
            $pdf = PDF::loadView('admin.order.invoice', $data);
            return $pdf->download('alluneed.pdf');
        } else {
            return redirect()->back()->with('status', 'No Order Found');
        }
    }

    public function proceedorder($order_id)
    {
        if (Order::where('id', $order_id)->exists()) {
            $orders = Order::find($order_id);
            return view('admin.order.proceed', compact('orders'));
        } else {
            return redirect()->back()->with('status', 'No Order Found');
        }
    }

    public function trackingstatus(Request $request, $order_id)
    {
        $orders = Order::find($order_id);
        if ($orders->order_status != "2") {
            $orders->tracking_msg = $request->input('tracking_msg');
            $orders->update();
            return redirect()->back()->with('status', 'Tracking Status Updated');
        } else {
            return redirect()->back()->with('status', 'Order is Cancelled');
        }
    }

    public function cancelorder(Request $request, $order_id)
    {
        $orders = Order::find($order_id);
        if ($orders->tracking_msg != NULL) {
            $orders->cancel_reason = $request->input('cancel_reason');
            $orders->tracking_msg = "Cancelled when " . $orders->tracking_msg;
            $orders->order_status = "2"; // 2= cancelled
            $orders->update();
            return redirect()->back()->with('status', 'Order Cancelled');
        } else {
            return redirect()->back()->with('status', 'update your tracking Status');
        }
    }

    public function completeorder(Request $request, $order_id)
    {
        $orders = Order::find($order_id);
        if ($orders->tracking_msg != NULL) {
            if ($orders->order_status != "2") { //2=Order cancelled
                $orders->tracking_msg = "Completed when " . $orders->tracking_msg;
                if ($orders->payment_status == "0") {
                    $orders->payment_status = $request->input('cash_received') == TRUE ? '1' : '0';
                }
                $orders->order_status = "1"; // 1 = order completed
                $orders->update();
                return redirect()->back()->with('status', 'Order Cancelled');
            } else {
                return redirect()->back()->with('status', 'Your Order is Cancelled!');
            }
        } else {
            return redirect()->back()->with('status', 'Updated your tracking status');
        }
    }
}

@extends('layouts.vendor')

@include('layouts.inc.encrypt')

@section('title')
	Order View
@endsection

@section('content')
    <div class="container-fluid mt-5">

        <div class="card mb-4 shadow-sm bg-gray-100 border-left-primary">
            <div class="card-body d-sm-flex align-items-center justify-content-between">
                <h6>
                    <a href="{{ url('vendor/orders') }}">Orders</a>
                    <span><i class="fas fa-angle-right mx-1"></i></span>
                    <span>Order Detail</span>
                </h6>
                <span>
                    @php
                        $encrypted = encrypt_decrypt('encrypt', $order->id);
                    @endphp
                    <a href="{{ url('v/generate-invoice/'.$encrypted) }}" class='btn btn-sm bg-gradient-success p-1 text-white'>
                        <i class="fa fa-download mr-1"></i>Generate Invoice
                    </a>
                </span>
            </div>
        </div>

        <h5 class="text-dark my-4 font-weight-bold">
            <span class="page-title-icon bg-gradient-primary mr-2">
                <i class="fa fa-bar-chart" aria-hidden="true"></i>
            </span>
            Order Detail
        </h5>

        <div class="row">

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card shadow-sm border-left-primary h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tracking No.</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{ $order->tracking_no }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-md-6 mb-4">
                <div class="card shadow-sm border-left-primary h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tracking Msg</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    {{ isset($orders->tracking_msg) == true? $orders->tracking_msg:'No Message Updated' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card shadow-sm border-left-primary h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Payment Method</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{ $order->payment_mode }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card shadow-sm border-left-primary h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            {{--
                                payment_status = 0 = Nothing paid, 1 = Cash paid, 2 = Razorpay payment successful, 3 = Razorpay payment failed, 4 =  pay, stripe.
                            --}}
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Payment Status</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    @if ($order->payment_status == '0')
                                        COD - Pending
                                    @elseif($order->payment_status == '1')
                                        COD - Paid
                                    @elseif($order->payment_status == '2')
                                        Razor Payment Successful
                                    @elseif($order->payment_status == '3')
                                        Razor Payment Failed
                                    @elseif($order->payment_status == '4')
                                        Stripe Payment Successful
                                    @elseif($order->payment_status == '5')
                                        Stripe Payment Failed
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card shadow-sm border-left-primary h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Payment ID</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    {{ isset($order->payment_id) == true? $order->payment_id:'COD Payment - No ID' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card shadow-sm border-left-primary h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Order Status</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    @if ($order->order_status == '0')
                                        Pending
                                    @elseif($order->order_status == '1')
                                        Completed
                                    @elseif($order->order_status == '2')
                                        Cancelled
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-md-6 mb-4">
                <div class="card shadow-sm border-left-primary h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Cancelled Reason</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    {{ isset($order->cancel_reason) == true? $order->cancel_reason:'Order is Not Cancelled' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <hr class='hr-dark'>

        <h5 class="text-dark my-4 font-weight-bold">
            <span class="page-title-icon bg-gradient-primary mr-2">
                <i class="fa fa-bar-chart" aria-hidden="true"></i>
            </span>
            Order Items
        </h5>

        <div class="row mb-5">
            <div class='col-md-12'>
                <div class="table-responsive shadow-sm">
                    <table class='table table-striped table-bordered'>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Item</th>
                                <th>Vendor</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Grand Total</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $total = "0";
                            @endphp

                            @foreach ($order->orderitems as $item)
                                @php
                                    $vendor_id = $item->products->user->id;
                                    $vendor = App\Models\Models\Request_vendor::where('user_id', $vendor_id)->get();
                                @endphp
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->products->name }}</td>
                                <td>
                                    @foreach($vendor as $v)
                                        {{ $v->vendor_name }}
                                    @endforeach
                                </td>
                                <td>{{ $item->quantity }}</td>
                                <td>$ {{number_format( $item->price,0) }}</td>
                                <td>$ {{ number_format($item->price * $item->quantity,0) }}</td>
                            </tr>

                            @php
                                $total = $total + ($item->price * $item->quantity);
                            @endphp

                            @endforeach

                            <tr>
                                <td colspan="5" class='text-right'>Sub Total</td>
                                <td>$ {{ number_format($total,0) }}</td>
                            </tr>

                            <tr>
                                <td colspan="5" class='text-right'>Tax-Amount</td>
                                <td>
                                    {{-- Grand_Total = total_amount * Tax/ 100 --}}
                                    @if (isset($item->tax_amt))
                                        @php
                                            $tax = $item->tax_amt;
                                            $tax_total = ($total * $tax)/100;
                                        @endphp
                                        $ {{ number_format($tax_total,0) }}
                                    @else
                                        0
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td colspan="5" class='text-right'>Grand Total</td>
                                <td>
                                    @if (isset($item->tax_amt))
                                        @php
                                            $grandtotal = $tax_total + $total;
                                        @endphp
                                        $ {{ number_format($grandtotal,0) }}
                                    @else
                                        $ {{ number_format($total,0) }}
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <hr class='hr-dark'>

        <h5 class="text-dark my-4 font-weight-bold">
            <span class="page-title-icon bg-gradient-success mr-2">
                <i class="fa fa-bar-chart" aria-hidden="true"></i>
            </span>
            Customer Detail
        </h5>

        <div class="row">

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card shadow-sm border-left-success h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Full Name</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{ $order->user->name }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card shadow-sm border-left-success h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Sur Name</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    @if($order->user->Iname)
                                    {{ $order->user->Iname }}
                                    @else
                                    ---
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card shadow-sm border-left-success h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Email</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    <a href="mailto:{{ $order->user->email }}">{{ $order->user->email }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card shadow-sm border-left-success h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Address 1</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    @if($order->user->address1)
                                    {{ $order->user->address1 }}
                                    @else
                                    ---
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card shadow-sm border-left-success h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Address 2</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    @if($order->user->address2)
                                    {{ $order->user->address2 }}
                                    @else
                                    ---
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card shadow-sm border-left-success h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Phone</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    @if($order->user->phone)
                                        <a href="tel:{{ $order->user->phone }}" >{{ $order->user->phone }}</a>
                                    @else
                                    ---
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card shadow-sm border-left-success h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Alternate Phone</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    @if($order->user->alternate_phone)
                                        <a href="tel:{{ $order->user->alternate_phone }}" >{{ $order->user->alternate_phone }}</a>
                                    @else
                                    ---
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card shadow-sm border-left-success h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Country</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    @if($order->user->country)
                                    {{ $order->user->country }}
                                    @else
                                    ---
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card shadow-sm border-left-success h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">City</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    @if($order->user->city)
                                    {{ $order->user->city }}
                                    @else
                                    ---
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card shadow-sm border-left-success h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">State</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    @if($order->user->state)
                                    {{ $order->user->state }}
                                    @else
                                    ---
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card shadow-sm border-left-success h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pin Code (Zip Code)</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    @if($order->user->pincode)
                                    {{ $order->user->pincode }}
                                    @else
                                    ---
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
@endsection

@extends('layouts.admin')

@section('title')
	Order View
@endsection

@section('content')

    <div class="container-fluid mt-5">

        <div class="card mb-4 shadow-sm bg-gray-100 border-left-primary">
            <div class="card-body d-sm-flex align-items-center justify-content-between">
                <h6>
                    <a href="{{ url('orders') }}">Orders</a> 
                    <span><i class="fas fa-angle-right mx-1"></i></span> 
                    <span>Order View</span>
                </h6>
                <span>
                    <a href="{{ url('generate-invoice/'.$orders->id) }}" class='btn btn-sm bg-gradient-success p-1 text-white'>
                        <i class="fas fa-plus-circle mr-1"></i>Generate Invoice
                    </a>
                </span>
            </div>
        </div>

        <div class='row'>
            <div class='col-md-12'>
               <div class='card'>
                    <div class='card-body'>
                        <h5>Order Detail</h5>
                        <div class="row">

                            <div class="col-md-4 mt-3">
                                <div class="border p-2">
                                    <label>Trackig No</label>
                                    <h6>{{ $orders->tracking_no }}</h6>
                                </div>
                            </div>

                            <div class="col-md-8 mt-3">
                                <div class="border p-2">
                                    <label>Trackig Msg</label>
                                    <h6>{{ isset($orders->tracking_msg) == true? $orders->tracking_msg:'Nothing Updated' }}</h6>
                                </div>
                            </div>

                            <div class="col-md-4 mt-3">
                                <div class="border p-2">
                                    <label>Payment Method</label>
                                    <h6>{{ $orders->payment_mode }}</h6>
                                </div>
                            </div>


                            <div class="col-md-4 mt-3">
                                <div class="border p-2">
                                    <label>Payment Status</label>
                                    {{-- 
                                        payment_status = 0 = Nothing paid, 1 = Cash paid, 2 = Razorpay payment successful, 3 = Razorpay payment failed, 4 =  pay, stripe.
                                    --}}

                                    <h6>
                                        @if ($orders->payment_status == '0')
                                            COD - Pending
                                        @elseif($orders->payment_status == '1')
                                            COD - Paid
                                        @elseif($orders->payment_status == '2')
                                            Payment Successful
                                        @elseif($orders->payment_status == '3')
                                            Payment Failed
                                        @elseif($orders->payment_status == '4')
                                            Stripe Successful
                                        @elseif($orders->payment_status == '5')
                                            Stripe Failed
                                        @endif
                                    </h6>
                                </div>
                            </div>


                            <div class="col-md-4 mt-3">
                                <div class="border p-2">
                                    <label>Payment ID</label>
                                    <h6>{{ isset($orders->payment_id) == true? $orders->payment_id:'COD Payment - No ID' }}</h6>
                                </div>
                            </div>


                            <div class="col-md-4 mt-3">
                                <div class="border p-2">
                                    <label>Order Status</label>
                                    {{-- 0 - Pending
                                    1 - Completed
                                    2 - Rejected/Cancelled --}}
                                    <h6>
                                        @if ($orders->order_status == '0')
                                            Pending
                                        @elseif($orders->order_status == '1')
                                            Completed
                                        @elseif($orders->order_status == '2')
                                            Rejected/Cancelled
                                        @endif
                                    </h6>
                                </div>
                            </div>

                            <div class="col-md-8 mt-3">
                                <div class="border p-2">
                                    <label>Cancelled Reason</label>
                                    <h6>{{ isset($orders->cancel_reason) == true? $orders->cancel_reason:'Not Cancelled' }}</h6>
                                </div>
                            </div>

                        </div>

                        <hr class='hr-dark'>

                        <h5>Order Items</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <table class='table table-bordered'>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Item</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Grand Total</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php
                                            $total = "0";

                                        @endphp

                                        @foreach ($orders->orderitems as $item)
                                            
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->products->name }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>$ {{number_format( $item->price,0) }}</td>
                                            <td>$ {{ number_format($item->price * $item->quantity,0) }}</td>
                                        </tr>

                                        @php
                                            $total = $total + ($item->price * $item->quantity);
                                        @endphp

                                        @endforeach

                                        <tr>
                                            <td colspan="4" class='text-right'>Sub Total</td>
                                            <td>$ {{ number_format($total,0) }}</td>
                                        </tr>


                                        <tr>
                                            <td colspan="4" class='text-right'>Tax-Amount</td>
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
                                            <td colspan="4" class='text-right'>Grand Total</td>
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

                        <hr class='hr-dark'>
                        <h5>Customer Detail</h5>
                        <div class="row">

                            <div class="col-md-4 mt-3">
                                <div class="border p-2">
                                    <label>First Name</label>
                                    <h6>{{ $orders->user->name }}</h6>
                                </div>
                            </div>

                            <div class="col-md-4 mt-3">
                                <div class="border p-2">
                                    <label>Last Name</label>
                                    <h6>{{ $orders->user->Iname }}</h6>
                                </div>
                            </div>

                            <div class="col-md-4 mt-3">
                                <div class="border p-2">
                                    <label>Email ID</label>
                                    <h6>{{ $orders->user->email }}</h6>
                                </div>
                            </div>

                            <div class="col-md-6 mt-3">
                                <div class="border p-2">
                                    <label>Address 1</label>
                                    <h6>{{ $orders->user->address1 }}</h6>
                                </div>
                            </div>

                            <div class="col-md-6 mt-3">
                                <div class="border p-2">
                                    <label>Address 2</label>
                                    <h6>{{ $orders->user->address2 }}</h6>
                                </div>
                            </div>

                            <div class="col-md-4 mt-3">
                                <div class="border p-2">
                                    <label>City</label>
                                    <h6>{{ $orders->user->city }}</h6>
                                </div>
                            </div>

                            <div class="col-md-4 mt-3">
                                <div class="border p-2">
                                    <label>State</label>
                                    <h6>{{ $orders->user->state }}</h6>
                                </div>
                            </div>

                            <div class="col-md-4 mt-3">
                                <div class="border p-2">
                                    <label>Pin Code</label>
                                    <h6>{{ $orders->user->pincode }}</h6>
                                </div>
                            </div>

                        </div>
                    </div>
               </div>
            </div>
        </div>
    
    </div>

@endsection

@extends('layouts.frontend')

@section('title')
    Voucher
@endsection

@section('content')

@php
    $slname   = preg_replace('/[^a-z0-9]+/i', '.', trim(strtolower(Auth::user()->name)));
@endphp

<div class="mx-3 my-3 p-0">
    <div class="bc-icons-2">
            <nav>
                <ol class="breadcrumb bg-secondary">
                    <li>
                        <a class="link-text font-weight-bolder" href="{{ url('orders/'.$slname) }}">Your Orders</a>
                        <i class="fas fa-angle-right mx-2"></i>
                    </li>

                    <li class="active">
                        Voucher
                    </li>
                </ol>
            </nav>
    </div>
</div>

<div class="mx-3 px-4 inv my-3 py-4 invoice rounded">

    <div class="row">
        <div class="col-4 col-lg-6 bg-">
            <a target="_blank" href="{{ url('/')}}">
                <img src="{{ asset('assets/img/logo.png')}}" width="130px">
            </a>
        </div>
        <div class="col-8 col-lg-6">
            <h5 class="inv-header py-3 px-3 rounded">
                <span>INVOICE</span>
                <span id="printInvoice" class="btn btn-sm d-none d-md-block blue-gradient float-right print-btn d-print-none"><i class="fa fa-print"></i> Print</span>
            </h5>
        </div>
    </div>

    <hr>

    <div class="row">

        @foreach($order as $i)

        <div class="col-md-4 mb-4">
            <h5 class="mt-2 mb-4 inv-subheader">INVOICE INFO</h5>

            <p class="mb-1 inv-info d-flex">
                <span class="inv-subtitle">Order ID :</span>
                <span>&nbsp;#{{$i->tracking_no}}</span>
            </p>

            <p class="mb-1 inv-info d-flex">
                <span class="inv-subtitle">Order Date :</span>
                <span>&nbsp;{{date('F j, Y',strtotime($i->created_at))}}</span>
            </p>

            <p class="mb-1 inv-info d-flex">
                <span class="inv-subtitle">Order Status :</span>
                @if ($i->order_status == '0')
                    <span>Pending</span>
                @elseif($i->order_status == '1')
                    <span>Completed</span>
                @elseif($i->order_status == '2')
                    <span>Rejected/Cancelled</span>
                @endif

            </p>

            <p class="mb-1 inv-info d-flex">
                <span class="inv-subtitle">Tracking Msg :</span>
                <span>&nbsp;{{ isset($i->tracking_msg) == true? $i->tracking_msg:'Nothing Updated' }}</span>
            </p>

            <p class="mb-1 inv-info d-flex">
                <span class="inv-subtitle">Cancelled Reason :</span>
                <span>&nbsp;{{ isset($i->cancel_reason) == true? $i->cancel_reason:'Not Cancelled' }}</span>
            </p>

        </div>

        <div class="col-md-4 mb-4">
            <h5 class="mt-2 mb-4 inv-subheader">PAYMENT INFO</h5>

            <p class="mb-1 inv-info d-flex">
                <span class="inv-subtitle">Payment ID :</span>
                <span>&nbsp;{{ isset($i->payment_id) == true? $i->payment_id:'COD Payment - No ID' }}</span>
            </p>

            <p class="mb-1 inv-info d-flex">
                <span class="inv-subtitle">Payment Type :</span>
                <span>&nbsp;{{$i->payment_mode}}</span>
            </p>


            <p class="mb-1 inv-info d-flex">
                <span class="inv-subtitle">Payment Status :</span>
                <span>&nbsp;
                    @if ($i->payment_status == '0')
                        COD - Pending
                    @elseif($i->payment_status == '1')
                        COD - Paid
                    @elseif($i->payment_status == '2')
                        Payment Successful
                    @elseif($i->payment_status == '3')
                        Payment Failed
                    @elseif($i->payment_status == '4')
                        Stripe Successful
                    @elseif($i->payment_status == '5')
                        Stripe Failed
                    @endif
                </span>
            </p>

        </div>

        <div class="col-md-4 mb-4">
            <h5 class="mt-2 mb-4 inv-subheader">CUSTOMER INFO</h5>
            <p class="mb-1 inv-info"><i class="fas fa-user-tie"></i> :&nbsp;{{$i->user->name}}</p>
            <p class="mb-1 inv-info"><i class="fas fa-envelope"></i> :&nbsp;{{$i->user->email}}</p>
            <p class="mb-1 inv-info"><i class="fas fa-phone-square"></i> :&nbsp;{{$i->user->phone}}</p>
            <p class="mb-1 inv-info"><i class="fas fa-map-marker-alt"></i> :&nbsp;{{$i->user->address1}}, {{$i->user->address2}}</p>
        </div>

        @endforeach

    </div>

    <hr>

    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive-vertical shadow-sm" id="demo">
                <table id="table" class="table table-striped shadow-sm table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Item</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    @php
                        $total="0";
                        $itemno = "0";
                    @endphp
                    <tbody>
                        @foreach($orderitem as $i)

                            @php
                                $itemno = $itemno +1;
                            @endphp

                            <tr>
                                <td data-title="No.">{{$itemno}}</td>
                                <td data-title="Item">{{$i->products->name}}</td>
                                <td data-title="Image" class="cart-image">
                                    <a class="entry-thumbnail" href="{{url('collection/'.$i->products->subcategory->category->group->url.'/'.$i->products->subcategory->category->url.'/'.$i->products->subcategory->url.'/'.$i->products->url.'/'.Crypt::encrypt($i->products->id)) }}">
                                        <img src="{{ asset('uploads/products/'.$i->products->prod_image) }}" width="70" class="img-fluid rounded shadow-sm">
                                    </a>
                                </td>
                                <td data-title="Price">${{ number_format($i->price, 2) }}</td>
                                <td data-title="Qty">{{$i->quantity}}</td>
                                <td data-title="Total">${{ number_format($i->price * $i->quantity, 2) }}</td>
                            </tr>

                            @php $total = $total + ($i->quantity * $i->price) @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-lg-6 py-3 order-lg-1 order-2">
            <div class="inv-header rounded py-3 px-4 text-uppercase font-weight-bold">Terms and Conditions</div>
            <li class="mt-3 pb-2">
                A Tax Amount charge is calculated based on the values you have entered.
            </li>
            <li class="mt-3 pb-2">
                We will either contact you for instructions before shipping or cancel your order and notify you of such cancellation.
            </li>
            <li class="mt-3 pb-2">
                We generally do not charge your credit card until after your order has entered the shipping process or,
                until we make the digital product available to you.
            </li>

        </div>

        <div class="col-lg-6 py-3 order-lg-2 order-1">

            <div class="inv-header rounded px-4 py-3 text-uppercase font-weight-bold">Order summary </div>

            <div class="p-1">
                <ul class="list-unstyled">
                    <li class="d-flex justify-content-between py-3 border-bottom">
                        <strong class="text-muted font-weight-bold">Sub Total</strong>
                        <h5>
                            <strong class="blue-text font-weight-bold mr-5 pr-4">${{ number_format($total, 2) }}</strong>
                        </h5>
                    </li>
                    <li class="d-flex justify-content-between py-3 border-bottom">
                        <strong class="text-muted font-weight-bold">Tax Amount</strong>
                        <h5>
                            <strong class="blue-text font-weight-bold mr-5 pr-4">
                                {{-- tax_Total = total_amount * Tax/ 100 --}}
                                @if (isset($i->tax_amt))
                                    @php
                                        $tax = $i->tax_amt;
                                        $tax_total = ($total * $tax)/100;
                                    @endphp
                                    $ {{ number_format($tax_total,2) }}
                                @else
                                    0
                                @endif
                            </strong>
                        </h5>
                    </li>
                    <li class="d-flex justify-content-between py-3">
                        <strong class="text-muted font-weight-bold">Grand Total</strong>
                        <h5>
                            <strong class="blue-text font-weight-bold mr-5 pr-4">
                                @if (isset($i->tax_amt))
                                    @php
                                        $grandtotal = $tax_total + $total;
                                    @endphp
                                    $ {{ number_format($grandtotal,2) }}
                                @else
                                    $ {{ number_format($total,2) }}
                                @endif
                            </strong>
                        </h5>
                    </li>
                </ul>
            </div>
        </div>

    </div>

    <hr>

    <footer class="row">
        <div class="col-lg-12 text-center">
            Invoice was created on a computer and is valid without the signature and seal.
        </div>
    </footer>

</div>

@endsection

@section('scripts')
    <script>
        $('#printInvoice').click(function(){
            Popup($('.invoice')[0].outerHTML);
            function Popup(data)
            {
                window.print();
                return true;
            }
        });
    </script>
@endsection

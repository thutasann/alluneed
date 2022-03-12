@extends('layouts.vendor')

@include('layouts.inc.encrypt')

@section('title')
	Order Proceed
@endsection

@section('content')

@php
    $encrypted = encrypt_decrypt('encrypt', $orders->id);
@endphp

<div class="modal fade" id="CompleteOrderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title texxt-dark font-weight-bold">Complete this Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ url('v/order/complete-order/'.$encrypted) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="modal-body">
                    @if ($orders->payment_status == "0")
                        <label class="container-check">Received Payment ? <span class="text-primary">(Cash On Delivery)</span>
                            <input type="checkbox" name="cash_received" required />
                            <span class="checkmark"></span>
                        </label>
                        <p class="mt-2 text-dark">
                            <i class="fas fa-info-circle"></i>
                            Please Check the Box to confirm that you received the Cash from Customer.
                        </p>
                    @else
                        <h5>The Payment has been done Online</h5>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Complete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid mt-5">

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4 shadow-sm bg-gray-100 border-left-primary">
                <div class="card-body d-sm-flex align-items-center justify-content-between">
                    <h6>
                        <a href="{{ url('vendor/orders') }}">Orders</a>
                        <span><i class="fas fa-angle-right mx-1"></i></span>
                        <span>Order Proceed</span>
                    </h6>
                    <div>
                        <label hover-tooltip="Tracking No." tooltip-position="bottom" class="
                            @if ($orders->order_status == '0')
                                {{ "bg-gradient-warning" }}
                            @elseif ($orders->order_status == '1')
                                {{ "bg-gradient-success" }}
                            @elseif ($orders->order_status == '2')
                                {{ "bg-gradient-danger" }}
                            @endif
                            rounded py-1 px-2 text-white">#{{ $orders->tracking_no }}
                        </label>

                        <label hover-tooltip="Ordered Date" tooltip-position="bottom" class="bg-gradient-primary ml-1 rounded py-1 px-2 text-white">
                            {{ date('F j, Y',strtotime($orders->created_at)) }}
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('status')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row shadow-sm">
        <div class="col-md-12">
            <div class="card mb-3 pb-3">

                <div class="card-body">

                    <ul class="nav nav-tabs nav-justified md-tabs" id="myTabJust" role="tablist">
                        <li class="nav-item ">
                            <a class="nav-link active" id="orderproceed-tab-just" data-toggle="tab" href="#orderproceed-just" aria-selected="true">
                            Proceed Order
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="shipping-tab-just" data-toggle="tab" href="#shipping-just" aria-selected="false">
                            Proceed Shipping
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content pt-2" id="myTabContentJust">

                        {{-- order_proceed --}}
                        <div class="tab-pane animated slideInDown fade active show" id="orderproceed-just" role="tabpanel" aria-labelledby="orderproceed-tab-just">
                            <div class="p-lg-1">

                                <h5 class="text-dark mb-4 mt-2 font-weight-bold">
                                    <span class="page-title-icon bg-gradient-primary mr-2">
                                        <i class="fa fa-bar-chart" aria-hidden="true"></i>
                                    </span>
                                    Order Proceed
                                </h5>

                                <div class="row">

                                    <div class="col-xl-4 col-md-6 mb-4">
                                        <div class="card shadow-sm border-left-primary h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tracking Msg</div>
                                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                                            {{ isset($orders->tracking_msg) == true? $orders->tracking_msg: 'No Tracking Message Updated' }}
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
                                                            @if ($orders->order_status == '0')
                                                                Pending
                                                            @elseif($orders->order_status == '1')
                                                                Completed
                                                            @elseif($orders->order_status == '2')
                                                                <span class="text-danger font-weight-bold">Cancelled : </span>
                                                                {{ $orders->cancel_reason }}
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
                                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Payment Status</div>
                                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                                            @if ($orders->payment_status == '0')
                                                                Status: {{ _('Payment Pending') }} <br/>
                                                                Mode: {{ $orders->payment_mode }}
                                                            @elseif($orders->payment_status == '1')
                                                                Status : {{ _('Payment Pending') }} <br/>
                                                                Mode : {{ $orders->payment_mode }}
                                                            @elseif($orders->payment_status == '2')
                                                                {{ _('Paid Online') }}
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    {{-- Tracking status --}}
                                    <div class="col-md-6">
                                        <div class="card shadow-sm mt-3">
                                            <div class="card-body">
                                                <h5 class="font-weight-bold text-dark">Tracking Msg Status Update</h5>
                                                <hr>
                                                @if ($orders->order_status == "1")
                                                    {{ $orders->tracking_msg }}
                                                @elseif($orders->order_status == "2")
                                                    {{ $orders->tracking_msg }}
                                                @else
                                                    <form action="{{ url('v/order/update-tracking-status/'.$encrypted) }}" method="POST">
                                                        {{ csrf_field() }}
                                                        {{ method_field('PUT') }}
                                                        <div class="input-group mb-3">
                                                            <select name="tracking_msg" class="custom-select" required id="inputGroupSelect02">
                                                                <option value="">--Select--</option>
                                                                <option value="Pending" {{ $orders->tracking_msg == "Pending" ? 'selected' : '' }}>Pending</option>
                                                                <option value="Packed" {{ $orders->tracking_msg == "Packed" ? 'selected' : '' }}>Packed</option>
                                                                <option value="Shipped" {{ $orders->tracking_msg == "Shipped" ? 'selected' : '' }}>Shipped</option>
                                                                <option value="Delivered" {{ $orders->tracking_msg == "Delivered" ? 'selected' : '' }}>Delivered</option>
                                                            </select>
                                                            <div class="input-group-append">
                                                                <button type="submit" class="input-group-text bg-gradient-info text-white" for="inputGroupSelect02">
                                                                    Update
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Cancel Order --}}
                                    <div class="col-md-6">
                                        <div class="card shadow-sm mt-3">
                                            <div class="card-body">
                                                <h5 class="font-weight-bold text-dark">Cancel Order</h5>
                                                <hr>
                                                @if ($orders->order_status == "1")
                                                    Order - Completed
                                                @elseif($orders->order_status == "2")
                                                    {{ $orders->cancel_reason }}
                                                @else
                                                    <form action="{{ url('v/order/cancel-order/'.$encrypted) }}" method="POST">
                                                        {{ csrf_field() }}
                                                        {{ method_field('PUT') }}
                                                        <div class="input-group mb-3">
                                                            <select name="cancel_reason" class="custom-select" required id="inputGroupSelect02">
                                                                <option value="">--Select Cancel Reason---</option>
                                                                <option value="Customer was Not Available">Custom was Not Available</option>
                                                                <option value="Product was Damaged">Product was Damaged</option>
                                                                <option value="There was No response">There was No response</option>
                                                                <option value="It was Delayed">It was Delayed</option>
                                                            </select>
                                                            <div class="input-group-append">
                                                                <button type="submit" class="input-group-text bg-gradient-info text-white" for="inputGroupSelect02">
                                                                    Cancel
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Complete Order button --}}
                                    <div class="col-md-12">
                                        <div class="card shadow-sm mt-3">
                                            <div class="card-body">
                                                <h5 class="font-weight-bold text-dark">Complete Order</h5>
                                                <hr>
                                                @if ($orders->order_status == "0")
                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#CompleteOrderModal" class="btn bg-gradient-primary text-white">
                                                        Proceed to finish this order
                                                    </a>
                                                @elseif($orders->order_status == "1"  || $orders->order_status == "3")
                                                    <span class="text-success font-weight-bold">Order Completed !</span>
                                                @elseif($orders->order_status == "2")
                                                    <span class="text-danger font-weight-bold">Order Cancelled! So, You are Not allowed to complete this order.</span>
                                                @else
                                                    Nothing
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        {{-- Shipping --}}
                        <div class="tab-pane animated slideInDown fade " id="shipping-just" role="tabpanel" aria-labelledby="shipping-tab-just">
                            <div class="p-lg-1">

                                @if($orders->order_status == "0")
                                    <span class="text-danger mt-2 font-weight-bold">Proceed the order first!</span>
                                @elseif($orders->order_status == "2")
                                    <span class="text-danger mt-2 font-weight-bold">Order Cancelled! So, You are Not allowed to proceed this shipping.</span>
                                @elseif($orders->order_status == "3")
                                    <span class="text-success mt-2 font-weight-bold">Shipping was proceeded!</span>
                                @elseif($orders->order_status == "1")

                                    <h5 class="text-dark mb-3 mt-2 font-weight-bold">
                                        <span class="page-title-icon bg-gradient-success mr-2">
                                            <i class="fa fa-bar-chart" aria-hidden="true"></i>
                                        </span>
                                        Proceed Shipping
                                    </h5>

                                    <div class="row">

                                        <div class="col-xl-4 col-md-6 mb-4">
                                            <div class="card shadow-sm border-left-success h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Email</div>
                                                            <div class="h6 mb-0 font-weight-bold text-gray-800">
                                                                @if($orders->user->email)
                                                                    <a href="mailto:{{ $orders->user->email }}" >{{ $orders->user->email }}</a>
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
                                                                @if($orders->user->country)
                                                                {{ $orders->user->country }}
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
                                                                @if($orders->user->phone)
                                                                <a href='tel:{{$orders->user->phone}}'>{{$orders->user->phone}}</a>
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
                                                                @if($orders->user->city)
                                                                {{ $orders->user->city }}
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
                                                                @if($orders->user->state)
                                                                {{ $orders->user->state }}
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
                                                                @if($orders->user->pincode)
                                                                {{ $orders->user->pincode }}
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
                                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Address 1</div>
                                                            <div class="h6 mb-0 font-weight-bold text-gray-800">
                                                                @if($orders->user->address1)
                                                                {{ $orders->user->address1 }}
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
                                                                @if($orders->user->address2)
                                                                {{ $orders->user->address2 }}
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

                                    <h5 class="text-dark mb-3 mt-2 font-weight-bold">
                                        Choose Shipping Team to proceed shipping
                                    </h5>

                                    {{-- Shipping proceed form --}}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form action="{{ url('v/proceed-shipping/'.$orders->id) }}" method="POST">
                                                {{ csrf_field() }}

                                                <input name="shipping_date" type="hidden" value="{{ Carbon\Carbon::now()->format('m/d/Y') }}" />

                                                <div class="form-group">
                                                    <select name="team_id" class="form-control" required>
                                                        <option value="">--- Choose team ---</option>
                                                        @foreach($deliteams as $i)
                                                            <option value="{{ $i->id }}">
                                                                {{ $i->name }}
                                                                [ {{ $i->schedule }} ]
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class='form-group'>
                                                    <button type='submit' class='btn btn-primary'>Proceed shipping</button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>

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

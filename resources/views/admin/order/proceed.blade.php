@extends('layouts.admin')

@section('title')
	Order Proceed
@endsection

@section('content')

<div class="modal fade" id="CompleteOrderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Complete Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('order/complete-order/'.$orders->id) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="modal-body">
                    @if ($orders->payment_status == "0")
                        <h6>
                            <input type="checkbox" name="cash_received" required> Received Payment (Cash On Delivery)
                        </h6>
                        <p>Check the Box to confirm that you received the Cash from Customer Close this order</p>
                    @else 
                        <h5>The Payment has been done Online</h5>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('status')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card mb-4 shadow-sm bg-gray-100 border-left-primary">
                <div class="card-body d-sm-flex align-items-center justify-content-between">
                    <h6>
                        <a href="{{ url('orders') }}">Orders</a> 
                        <span><i class="fas fa-angle-right mx-1"></i></span> 
                        <span>Order Status</span>
                    </h6>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-body">

                    {{-- heading --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h5>Order Details</h5>
                        </div>
                        <div class="col-md-6">
                            <span class="float-right">
                                <label class="bg-gradient-warning py-1 px-2 text-white">Tracking Id: &nbsp; {{ $orders->tracking_no }}</label>
                            </span>
                        </div>
                    </div>

                    {{-- Order detail --}}
                    <div class="row">

                        <div class="col-md-4">
                            <div class="card shadow-sm border">
                                <h6 class="card-header">Tracking Status</h6>
                                <div class="card-body">
                                    <p>
                                        @if ($orders->tracking_msg === NULL)
                                            No Status Updated
                                        @else
                                            {{ $orders->tracking_msg }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card shadow-sm border">
                                <h6 class="card-header">Current Order Status</h6>
                                <div class="card-body">
                                    <p>
                                        @if ($orders->order_status == '0')
                                            Order Pending
                                        @elseif($orders->order_status == '1')
                                            Order Completed
                                        @elseif($orders->order_status == '2')
                                            Order Cancelled :
                                            {{ $orders->cancel_reason }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card shadow-sm border">
                                <h6 class="card-header">Payment Status</h6>
                                <div class="card-body">
                                    <p>
                                        @if ($orders->payment_status == '0')
                                            Status: {{ _('Payment Pending') }} <br/>
                                            Mode: {{ $orders->payment_mode }}
                                        @elseif($orders->payment_status == '1')
                                            Status : {{ _('Payment Pending') }} <br/>
                                            Mode : {{ $orders->payment_mode }}
                                        @elseif($orders->payment_status == '2')
                                            {{ _('Paid Online') }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- proceed --}}
                    <div class="row">

                        {{-- Tracking status --}}
                        <div class="col-md-6">
                            <div class="card mt-3">
                                <div class="card-body">
                                    <h5>Tracking Status Update</h5>
                                    <hr>
                                    @if ($orders->order_status == "1")
                                        {{ $orders->tracking_msg }}
                                    @elseif($orders->order_status == "2")
                                        {{ $orders->tracking_msg }}
                                    @else 
                                        <form action="{{ url('order/update-tracking-status/'.$orders->id) }}" method="POST">
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
                                                    <button type="submit" class="input-group-text bg-info text-white" for="inputGroupSelect02">
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
                            <div class="card mt-3">
                                <div class="card-body">
                                    <h5>Cancel Order</h5>
                                    <hr>
                                    @if ($orders->order_status == "1")
                                        Order - Completed
                                    
                                    @elseif($orders->order_status == "2")
                                        {{ $orders->cancel_reason }}

                                    @else 
                                        <form action="{{ url('order/cancel-order/'.$orders->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                            <div class="input-group mb-3">
                                                <select name="cancel_reason" class="custom-select" id="inputGroupSelect02">
                                                    <option value="">--Select---</option>
                                                    <option value="Customer Not Available">Custom Not Available</option>
                                                    <option value="Product Damage">Product Damage</option>
                                                    <option value="No response">No response</option>
                                                    <option value="Delayed">Delayed</option>
                                                </select>
                                                <div class="input-group-append">
                                                    <button type="submit" class="input-group-text bg-info text-white" for="inputGroupSelect02">
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
                        <div class="col-md-6">
                            <div class="card mt-3">
                                <div class="card-body">
                                    <h5>Complete Order</h5>
                                    <hr>
                                    @if ($orders->order_status == "0")
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#CompleteOrderModal" class="badge badge-pill badge-primary px-3 py-2">
                                            Proceed to finish this order
                                        </a>
                                    @elseif($orders->order_status == "1")
                                        Order Completed 
                                    @elseif($orders->order_status == "2")
                                        Order Cancelled.! So, You are Not allowed to complete this order
                                    @else 
                                        Nothing
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection
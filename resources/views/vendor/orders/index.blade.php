@extends('layouts.vendor')

@include('layouts.inc.encrypt')

@section('title')
	Orders
@endsection


@section('content')

    <div class="container-fluid mt-5">

        <div class="card mb-4 shadow-sm bg-gray-100 border-left-primary">
            <div class="card-body d-sm-flex align-items-center justify-content-between">
                <h6>
                    <a href="{{ url('/vendor-dashboard') }}">Vendor Dashboard</a>
                    <span><i class="fas fa-angle-right mx-1"></i></span>
                    <span>Orders</span>
                </h6>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-gray-600">Orders Table</h6>
                    </div>

                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{session('status')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @php $no = "0"; @endphp

                        <div class="table-responsive">
                            <table class='table table-striped table-bordered' id='datatable'>
                                <thead>
                                    <th>Order ID</th>
                                    <th>Tracking No</th>
                                    <th>Customer Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>View</th>
                                    <th>Proceed</th>
                                </thead>

                                <tbody>
                                    @foreach($orderitems as $oi)

                                        @php
                                            $no = $no + 1;
                                            $encrypted = encrypt_decrypt('encrypt', $oi->orders->id);
                                        @endphp

                                        <tr>
                                            <td>{{ $oi->orders->id }}</td>
                                            <td class="text-primary"># {{ $oi->orders->tracking_no }}</td>
                                            <td>{{ $oi->orders->user->name }}</td>
                                            <td>
                                                <a href="mailto:{{ $oi->orders->user->email }}" title="Send Mail to ({{ $oi->orders->user->email }})">
                                                    {{ $oi->orders->user->email }}
                                                </a>
                                            </td>
                                            <td>
                                                @if ($oi->orders->order_status == '0')
                                                    <span class="py-2 px-2 badge bg-gradient-warning text-white font-weight-bolder">Pending</span>
                                                @elseif($oi->orders->order_status == '1')
                                                    <span class="py-2 px-2 badge bg-gradient-success text-white font-weight-bolder">Completed</span>
                                                @elseif($oi->orders->order_status == '2')
                                                    <span class="py-2 px-2 badge bg-gradient-danger text-white font-weight-bolder">Cancelled</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('v/order-view/'.$encrypted ) }}" title="View" class="badge badge-pill text-white px-2 py-1 bg-gradient-primary">
                                                    <i class="fas fa-eye"></i> Order Detail
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ url('v/order-proceed/'.$encrypted ) }}" title="Proceed" class="badge badge-pill text-white px-2 py-1 bg-gradient-success">
                                                    <i class="fas fa-truck-loading"></i> Proceed order
                                                </a>
                                            </td>
                                        </tr>

                                    @endforeach
                                </tbody>

                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection

{{-- <span>
    <a href="{{ URL::current() }}" class='btn btn-sm bg-gradient-primary p-1 text-white'>
        All Orders
    </a>
    <a href="{{ URL::current()."?status=pending" }}" class='btn btn-sm bg-gradient-warning p-1 text-white'>
        Pending Orders
    </a>
    <a href="{{ URL::current()."?status=completed" }}" class='btn btn-sm bg-gradient-success p-1 text-white'>
        Completed Orders
    </a>
    <a href="{{ URL::current()."?status=cancelled" }}" class='btn btn-sm bg-gradient-danger p-1 text-white'>
        Cancelled Orders
    </a>

</span> --}}

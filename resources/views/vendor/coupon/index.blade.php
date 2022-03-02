@extends('layouts.vendor')

@include('layouts.inc.encrypt')

@section('title')
	Coupons
@endsection

@section('content')

    <div class="container-fluid mt-5">

        <div class="card mb-4 shadow-sm bg-gray-100 border-left-primary">
            <div class="card-body d-sm-flex align-items-center justify-content-between">
                <h6>
                    <a href="{{ url('/vendor-dashboard') }}">Vendor Dashboard</a>
                    <span><i class="fas fa-angle-right mx-1"></i></span>
                    <span>Coupons</span>
                </h6>
                <span>
                    <a href="#" class='btn btn-sm bg-gradient-primary p-1 text-white' data-toggle="modal" data-target="#couponmodal">
                        <i class="fas fa-plus-circle mr-1"></i>Add
                    </a>
                </span>
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

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm my-4">

                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-gray-600">Coupon Table</h6>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class='table table-striped table-bordered' id='datatable'>
                                <thead>
                                    <th>ID</th>
                                    <th>Offer</th>
                                    <th>Coupon Code</th>
                                    <th>Expiry DateTime</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </thead>

                                <tbody>
                                    @foreach ($coupon as $couponitem)
                                        @php
                                            $encrypted = encrypt_decrypt('encrypt', $couponitem->id);
                                        @endphp
                                        <tr>
                                            <td>{{ $couponitem->id }}</td>
                                            <td>{{ $couponitem->offer_name }}</td>
                                            <td>{{ $couponitem->coupon_code }}</td>
                                            <td>{{ $couponitem->end_datetime }}</td>
                                            <td>
                                                @if ($couponitem->status == "1")
                                                    <span class="py-2 px-2 badge bg-gradient-danger text-white font-weight-bolder">Disabled</span>
                                                @else
                                                    <span class="py-2 px-2 badge bg-gradient-info text-white font-weight-bolder">Active</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('v/coupon-edit/'.$encrypted) }}" title="Edit" class="mr-1 badge badge-pill text-white px-2 py-1 bg-gradient-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            <table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        @include('vendor.coupon.addcoupon')

    </div>

@endsection

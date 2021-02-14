@extends('layouts.admin')

@section('title')
	Coupons
@endsection

@section('content')

    <div class="container-fluid mt-5">

        <div class="card mb-4 shadow-sm bg-gray-100 border-left-primary">
            <div class="card-body d-sm-flex align-items-center justify-content-between">
                <h6>
                    <a href="{{ url('/dashboard') }}">Dashboard</a> 
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

        <div class="modal fade"  id="couponmodal" tabindex="-1" aria-labelledby="couponmodal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Coupon</h5>
                        <span class="font-weight-bold" style="cursor: pointer;" data-dismiss="modal" aria-label="Close">&times;</span>
                    </div>
                    <form action="{{ url('coupon-store') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="modal-body">
                            <div class="row">
                                {{-- offer_name --}}
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label>Offer Name</label>
                                        <input type="text" name="offer_name" class='form-control' placeholder='Enter Offer Name' required>
                                    </div>
                                </div>

                                {{-- product_id --}}
                                <div class="col-md-6 mb-2">
                                    <label>Products (Optional)</label>
                                    <div class="form-group">
                                        <select name="product_id" class="form-control select2-products" style="width: 100%;">
                                            <option value="0">Select</option>
                                            @foreach ($product as $prod_item)
                                                <option value="{{ $prod_item->id }}">{{ $prod_item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- coupon_code --}}
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label>Coupon Code</label>
                                        <input type="text" name="coupon_code" class="form-control" placeholder="Enter Coupon Code" required>
                                    </div>
                                </div>

                                {{-- coupon_limit --}}
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label>Coupon Limit</label>
                                        <input type="number" name="coupon_limit" class="form-control" placeholder="Enter Coupon Limit" required>
                                    </div>
                                </div>

                                {{-- coupon_type --}}
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label>Coupon Type</label>
                                        <select name="coupon_type" class="form-control">
                                            <option value="">Select your Coupon Type</option>
                                            <option value="1">Percentage</option>
                                            <option value="2">Amount</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- coupon_price --}}
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label>Coupon Price</label>
                                        <input type="text" name="coupon_price" class="form-control" placeholder="Enter Coupon Price" required>
                                    </div>
                                </div>

                                {{-- start_datetime --}}
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label>Start Date Time</label>
                                        <input type="datetime-local" name="start_datetime" class="form-control" required>
                                    </div>
                                </div>

                                {{-- end_datetime --}}
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label>End Date Time</label>
                                        <input type="datetime-local" name="end_datetime" class="form-control" required>
                                    </div>
                                </div>

                                {{-- status --}}
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <input type="checkbox" name="status"> (0=Active, 1=Blocked)
                                    </div>
                                </div>

                                {{-- visibility_status --}}
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label>Visibility Status</label>
                                        <input type="checkbox" name="visibility_status"> (0=Show, 1=Hide)
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Coupon</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

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
                                        <tr>
                                            <td>{{ $couponitem->id }}</td>
                                            <td>{{ $couponitem->offer_name }}</td>
                                            <td>{{ $couponitem->coupon_code }}</td>
                                            <td>{{ $couponitem->end_datetime }}</td>
                                            <td>
                                                @if ($couponitem->status == "1")
                                                    <label class="badge badge-pill badge-danger">Disabled</label>
                                                @else 
                                                    <label class="badge badge-pill badge-success">Active</label>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('admin/coupon-edit/'.$couponitem->id) }}" class="btn btn-sm btn-primary">Edit</a>
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

    </div>

@endsection
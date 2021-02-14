@extends('layouts.admin')

@section('title')
	Coupon Edit
@endsection

@section('content')

    <div class="container-fluid mt-5">

        <div class="card mb-4 shadow-sm bg-gray-100 border-left-primary">
            <div class="card-body d-sm-flex align-items-center justify-content-between">
                <h6>
                    <a href="{{ url('admin/coupon-view') }}">Coupons</a> 
                    <span><i class="fas fa-angle-right mx-1"></i></span> 
                    <span>Coupon Edit</span>
                </h6>
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
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <form action="{{ url('coupon-update/'.$coupon->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="row">
                                {{-- offer_name --}}
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label>Offer Name</label>
                                        <input type="text" name="offer_name" value="{{ $coupon->offer_name }}" class='form-control' placeholder='Enter Offer Name' required>
                                    </div>
                                </div>

                                {{-- product_id --}}
                                <div class="col-md-6 mb-2">
                                    <label>Products (Optional)</label>
                                    <div class="form-group">
                                        <select name="product_id" class="form-control select2-products" style="width: 100%;">
                                            <option value="0">Select</option>
                                            @foreach ($product as $prod_item)
                                                <option value="{{ $prod_item->id }}" {{ "$prod_item->id" == "$coupon->product_id" ? 'selected': '' }}>
                                                    {{ $prod_item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- coupon_code --}}
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label>Coupon Code</label>
                                        <input type="text" name="coupon_code" value="{{ $coupon->coupon_code }}" class="form-control" placeholder="Enter Coupon Code" required>
                                    </div>
                                </div>

                                {{-- coupon_limit --}}
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label>Coupon Limit</label>
                                        <input type="number" name="coupon_limit" value="{{ $coupon->coupon_limit }}" class="form-control" placeholder="Enter Coupon Limit" required>
                                    </div>
                                </div>

                                {{-- coupon_type --}}
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label>Coupon Type</label>
                                        <select name="coupon_type" class="form-control">
                                            <option value="">Select your Coupon Type</option>
                                            <option value="1" {{ "$coupon->coupon_type" == "1" ? 'selected' : '' }}>Percentage</option>
                                            <option value="2" {{ "$coupon->coupon_type" == "2" ? 'selected' : '' }}>Amount</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- coupon_price --}}
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label>Coupon Price</label>
                                        <input type="text" name="coupon_price" value="{{ $coupon->coupon_price }}" class="form-control" placeholder="Enter Coupon Price" required>
                                    </div>
                                </div>

                                {{-- start_datetime --}}
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label>Start Date Time</label>
                                        <input type="datetime-local" name="start_datetime" value="{{ date('Y-m-d\TH:i' , strtotime($coupon->start_datetime )) }}" class="form-control" required>
                                    </div>
                                </div>

                                {{-- end_datetime --}}
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label>End Date Time</label>
                                        <input type="datetime-local" name="end_datetime" value="{{ date('Y-m-d\TH:i' , strtotime($coupon->end_datetime )) }}" class="form-control" required>
                                    </div>
                                </div>

                                {{-- status --}}
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <input type="checkbox" name="status" {{ $coupon->status == "1" ? 'checked' : '' }}> (0=Active, 1=Blocked)
                                    </div>
                                </div>

                                {{-- visibility_status --}}
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label>Visibility Status</label>
                                        <input type="checkbox" name="visibility_status" {{ $coupon->visibility_status == "1" ? 'checked' : '' }}> (0=Show, 1=Hide)
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12 my-4">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Update Coupon</button>
                                        <button type="reset" class="btn btn-secondary">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
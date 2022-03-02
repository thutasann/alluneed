@extends('layouts.vendor')

@section('title')
	Coupon Edit
@endsection

@section('content')

    <div class="container-fluid mt-5">

        <div class="card mb-4 shadow-sm bg-gray-100 border-left-primary">
            <div class="card-body d-sm-flex align-items-center justify-content-between">
                <h6>
                    <a href="{{ url('vendor/coupons') }}">Coupons</a>
                    <span><i class="fas fa-angle-right mx-1"></i></span>
                    <span>Coupon Edit</span>
                </h6>
                <span>
                    <a href="#" class='btn bg-gradient-primary text-white' data-toggle="modal" data-target="#sendcouponmodal">
                        <i class="fas fa-envelope mr-1"></i>Send to Customer
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

        @if (session('status-sent'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('status-sent')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <form action="{{ url('vcoupon-update/'.$coupon->id) }}" method="POST">
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

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm my-4">

                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-gray-600">Customers this coupon was sent to</h6>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class='table table-striped table-bordered' id='datatable'>
                                <thead>
                                    <th>No.</th>
                                    <th>Offer Name</th>
                                    <th>Customer Email</th>
                                    <th>Sent Date</th>
                                </thead>

                                <tbody>
                                    @php $n = "0"; @endphp
                                    @foreach ($coupon_users as $i)
                                        @php $n = $n + 1; @endphp
                                        <tr>
                                            <td>{{ $n }}</td>
                                            <td>{{ $i->coupon->offer_name }}</td>
                                            <td>
                                                <a href='mailto:{{$i->user_email}}'>{{ $i->user_email }}</a>
                                            </td>
                                            <td>{{ date('Y-m-d' , strtotime($i->created_at )) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            <table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        @include('vendor.coupon.sendcoupon')
    </div>

    <style>
        .select2-container--default .select2-selection--single{
            display: block;
            width: 100%;
            height: calc(1.5em + .75rem + 2px);
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #6e707e;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #d1d3e2;
            border-radius: .35rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #6e707e;
            line-height: 28px;
        }
        .select2-container--default .select2-search--dropdown .select2-search__field{
            outline:none;
            border-radius: 4px;
            border: 1px solid #9c9b9b;
        }
    </style>

@endsection

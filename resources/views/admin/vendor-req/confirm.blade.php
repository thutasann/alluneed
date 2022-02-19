@extends('layouts.admin')

@section('title')
	Vendor Request Confirm
@endsection

@section('content')
    <div class="container-fluid mt-5">

        <div class="card mb-4 shadow-sm bg-gray-100 border-left-primary">
            <div class="card-body d-sm-flex align-items-center justify-content-between">
                <h6>
                    <a href="{{ url('/vendor-requests') }}">Vendor Requests</a>
                    <span><i class="fas fa-angle-right mx-1"></i></span>
                    <span>Vendor Request Confirm</span>
                </h6>
                <span>
                    <a href="{{ url('registered-user') }}" class='btn btn-sm bg-gradient-primary p-1 text-white'>
                        <i class="fas fa-users mr-1"></i>View All Users
                    </a>
                </span>
            </div>
        </div>

        <div class='row'>
            <div class='col-md-12'>
                <div class='card shadow-sm mb-4'>

                    <div class="card-header py-3 d-flex align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-gray-600">Vendor Request Confirm</h6>
                        <span class="text-primary font-weight-bolder">{{ $reqv->created_at->diffForHumans() }}</span>
                    </div>

                    <div class='card-body'>

                        @if (session('status-confirmed'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{session('status-confirmed')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <form action="{{ url('vendor-confirmed/' .$reqv->id) }}" method="POST">
                            {{ csrf_field() }}

                            <input type="hidden" name="vendor_name" value="{{ $reqv->vendor_name }}" />
                            <input type="hidden" name="description" value="{{  $reqv->description }}" />
                            <input type="hidden" name="name" value="{{  $reqv->users->name }}" />
                            <input type="hidden" name="email" value="{{  $reqv->users->email }}" />
                            <input type="hidden" name="created_at" value="{{ date('F j, Y',strtotime($reqv->created_at)) }}" />

                            <div class='row'>

                                <div class="col-xl-12 col-md-12 mb-4">
                                    <div class="page-header my-3 ml-1">
                                        <h4 class="page-title text-dark">
                                            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                                            <i class="fa fa-bar-chart" aria-hidden="true"></i>
                                            </span> Vendor Info
                                        </h4>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 mb-4">
                                    <div class="card border-left-primary h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">User Name</div>
                                                    <div class="mb-0 font-weight-bold text-gray-800">{{ $reqv->users->name }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 mb-4">
                                    <div class="card border-left-primary h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Email</div>
                                                    <div class="mb-0 font-weight-bold text-gray-800">
                                                        <a href="mailto:{{ $reqv->users->email }}">{{ $reqv->users->email }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 mb-4">
                                    <div class="card border-left-primary h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Vendor Display Name</div>
                                                    <div class="mb-0 font-weight-bold text-gray-800">
                                                        {{ $reqv->vendor_name }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-12 col-md-12 mb-4">
                                    <div class="card border-left-primary h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Description about Vendor</div>
                                                    <div class="mb-0 font-weight-bold text-gray-800">
                                                        @if($reqv->description)
                                                            {{ $reqv->description }}
                                                        @else
                                                            ---
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-12 col-md-12 mb-4">
                                    <div class="page-header my-3 ml-1">
                                        <h4 class="page-title text-dark">
                                            <span class="page-title-icon bg-gradient-success text-white mr-2">
                                            <i class="fa fa-bar-chart" aria-hidden="true"></i>
                                            </span> Payment Info
                                        </h4>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 mb-4">
                                    <div class="card border-left-success h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Payment Method</div>
                                                    <div class="mb-0 font-weight-bold text-gray-800">{{ $reqv->payment_mode }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 mb-4">
                                    <div class="card border-left-success h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Payment ID</div>
                                                    <div class="mb-0 font-weight-bold text-gray-800">
                                                        <a href="https://dashboard.razorpay.com/app/payments/{{ $reqv->payment_id }}" target="_blank">
                                                            {{ $reqv->payment_id }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 mb-4">
                                    <div class="card border-left-success h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Payment Status</div>
                                                    <div class="mb-0 font-weight-bold text-gray-800">
                                                        @if ($reqv->payment_status == '0')
                                                            COD - Pending
                                                        @elseif($reqv->payment_status == '1')
                                                            COD - Paid
                                                        @elseif($reqv->payment_status == '2')
                                                            Razor Payment Successful
                                                        @elseif($reqv->payment_status == '3')
                                                            Razor Payment Failed
                                                        @elseif($reqv->payment_status == '4')
                                                            Stripe Successful
                                                        @elseif($reqv->payment_status == '5')
                                                            Stripe Failed
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                {{-- button --}}
                                @if($reqv->confirm == "0")
                                    <div class="col-md-12 my-4">
                                        <div class='form-group'>
                                            <button type='submit' class='btn btn-primary text-white'>Confirm Vendor Request</button>
                                        </div>
                                    </div>
                                @elseif($reqv->confirm == "1")
                                    <div class="col-md-12 my-4">
                                        <div class="alert alert-success fade show" role="alert">
                                            This vendor request was confirmed
                                        </div>
                                    </div>
                                @endif
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

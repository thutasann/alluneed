@extends('layouts.frontend')

@include('layouts.inc.encrypt')

@section('title')
    Your Orders
@endsection

@section('content')

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">

            @if(count($orders) > 0)

                <div class="page-header mb-4 mt-4 ml-3">
                    <h4 class="page-title font-weight-bolder">
                        <span class="page-title-icon bg-gradient-primary text-white mr-2">
                        <i class="fa fa-bar-chart" aria-hidden="true"></i>
                        </span> Your Orders
                    </h4>
                </div>

                <div class="row">
                    <div class="col-lg-2 order-tab">
                        <div class="sidebar">
                            <div class="widget">
                                <ul class='act-tab'>
                                    <li class='waves-effect py-3 px-3 my-2'>
                                        <a href="{{ URL::current() }}" class="text-muted font-weight-bolder">
                                            <i class="fas fa-truck"></i>&nbsp; All Orders
                                        </a>
                                    </li>
                                    <li class='waves-effect py-3 px-3 my-2'>
                                        <a href='{{ URL::current() }}' class="text-muted font-weight-bolder">
                                            <i class="fas fa-truck-loading"></i>&nbsp; Pending Orders
                                        </a>
                                    </li>
                                    <li class='waves-effect py-3 px-3 my-2'>
                                        <a href='{{ URL::current() }}' class="text-muted font-weight-bolder">
                                            <i class="fas fa-truck-moving"></i>&nbsp; Completed Orders
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    @php

                        $orderno = "0";
                        $slname   = preg_replace('/[^a-z0-9]+/i', '.', trim(strtolower(Auth::user()->name)));

                        $key = 'qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';
                        $private_secret_key = '1f4276388ad3214c873428dbef42243f' ;

                    @endphp

                    <div class="col-lg-10 order-list">

                        <div class="table-responsive-vertical shadow-z-1" id="demo">
                            <table id='datatable' class="table table-striped shadow table-bordered table-hover">

                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>OrderID</th>
                                        <th>Date</th>
                                        <th>Order Status</th>
                                        <th>Payment Method</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($orders as $i)

                                        @php

                                            $orderno = $orderno +1;
                                            $encrypted = encrypt_decrypt('encrypt', $i->id);

                                        @endphp

                                        <tr>

                                            <td data-title="No.">{{$orderno}}</td>
                                            <td data-title="OrderID">#{{$i->tracking_no}}</td>
                                            <td data-title="Date">{{date('F j,  Y',strtotime($i->created_at))}}</td>

                                            <td data-title="Order Status">
                                                @if($i->order_status == '0')
                                                    <label class="py-2 px-3 badge badge-warning font-weight-normal">Pending
                                                @endif
                                            </td>

                                            <td data-title="Payment Method">
                                                <label class="py-2 px-3 badge bg-gradient-info font-weight-bolder">{{$i->payment_mode}}
                                            </td>

                                            <td data-title="Action">
                                                <a href="{{url('voucher/'.$encrypted.'/'.$slname )}}" class="badge badge-pill blue-gradient px-3 py-2 mb-2">View Voucher</a>
                                            </td>

                                        </tr>

                                    @endforeach
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>

            @else

                <div class="row">
                    <div class="col-md-12 mycard py-3 text-center">
                        <div class="mycards">
                            <h4 class="font-weight-bolder mb-5 mt-3 empty-header">Your Order List is currently empty.</h4>
                            <img src="{{ asset('assets/img/empty-cart.png')}}" class="mt-4">
                            <a href="{{ url('collections') }}" class="mt-4 btn btn-upper bg-gradient-primary text-white outer-left-xs rounded">Continue Shopping</a>
                        </div>
                    </div>
                </div>

            @endif

        </div>
    </div>
</div>

@endsection

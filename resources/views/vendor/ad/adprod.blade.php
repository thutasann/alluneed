@extends('layouts.vendor')

@section('title')
	Upload Ad Products
@endsection

@include('layouts.inc.encrypt')


@section('content')
    <div class="container-fluid mt-5">

        @include('vendor.ad.prod_upload')

        <div class="card mb-4 shadow-sm bg-gray-100 border-left-primary">
            <div class="card-body d-sm-flex align-items-center justify-content-between">
                <h6>
                    <a href="{{ url('vendor/manage-ads') }}">Manage Ad</a>
                    <span><i class="fas fa-angle-right mx-1"></i></span>
                    <span>Upload Products for <span class="text-primary font-weight-bold">{{ $slider->heading }}</span></span>
                </h6>
                <span>
                    <a href="#" class='btn btn-sm bg-gradient-primary p-1 text-white' data-toggle="modal" data-target="#addprod">
                        <i class="fas fa-plus-circle mr-1"></i>Upload Product
                    </a>
                </span>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-gray-600"> Ad's Products Table</h6>
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
                        <div class="table-responsive">
                            <table class='table table-striped table-bordered' id='datatable'>

                                <thead>
                                    <th>ID</th>
                                    <th>Product</th>
                                    <th>Image</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </thead>

                                <tbody>
                                    @foreach ($slider_prods as $item)

                                        @php
                                            $encrypted = encrypt_decrypt('encrypt', $item->id);
                                            $slname   = preg_replace('/[^a-z0-9]+/i', '_', trim(strtolower($item->product->name)));
                                        @endphp

                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->product->name }}</td>
                                            <td>
                                                <img src="{{ asset('uploads/products/prod/'.$item->product->prod_image)}}" alt="Product Image" width="50px">
                                            </td>

                                            <td>{{ date('F j, Y',strtotime($item->created_at)) }}</td>
                                            <td>
                                                <a href="{{ url('vendor/product-edit/'.$encrypted.'/'.$slname ) }}" title="Edit {{ $item->product->name }}" class="badge badge-pill text-white mr-1 px-2 py-1 bg-gradient-primary">
                                                    <i class="fas fa-edit"></i>
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

@section('scripts')

<script type="text/javascript" src="{{ asset('assets/js/customfile-ad.js') }} "></script>

@endsection

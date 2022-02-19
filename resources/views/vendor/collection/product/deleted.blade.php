@extends('layouts.vendor')

@include('layouts.inc.encrypt')

@section('title')
	Product Trashes
@endsection

@section('content')
    <div class="container-fluid mt-5">

        <div class="card mb-4 shadow-sm bg-gray-100 border-left-primary">
            <div class="card-body d-sm-flex align-items-center justify-content-between">
                <h6>
                    <a href="{{ url('vendor/products')}}">Products</a>
                    <span><i class="fas fa-angle-right mx-1"></i></span>
                    <span>Trash</span>
                </h6>
                <span>
                    @if(count($products) == 0)
                    @else
                        <a href="{{ url('vendor/empty-product-trash') }}" class='btn btn-sm bg-gradient-danger p-1 text-white'>
                            <i class="far fa-trash-alt mr-1"></i>Empty Trash
                        </a>
                    @endif
                </span>
            </div>
        </div>

        <div class='row'>
            <div class='col-md-12'>
                <div class='card shadow-sm mb-4'>
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-gray-600">Product Trash Table</h6>
                    </div>

                    <div class='card-body'>

                        @if (session('restore-status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{session('restore-status')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if (session('del-trash-status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{session('del-trash-status')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if (session('empty-trash-status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{session('empty-trash-status')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class='table table-striped table-bordered' id='datatable'>

                                <thead>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Brand</th>
                                    <th>Category</th>
                                    <th>Qty</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </thead>

                                <tbody>

                                    @foreach ($products as $item)

                                    @php
                                        $encrypted = encrypt_decrypt('encrypt', $item->id);
                                    @endphp

                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->subcategory->name}}</td>
                                        <td>{{$item->subcategory->category->name}}</td>
                                        <td>{{$item->quantity}}</td>
                                        <td>
                                            <img src="{{ asset('uploads/products/prod/'.$item->prod_image) }}" alt="Product Image" width="50px">
                                        </td>
                                        <td>
                                            @if ($item->status == '1')
                                                <span class="py-2 px-2 badge bg-gradient-danger text-white font-weight-bolder">Hidden</span>
                                            @else
                                                <span class="py-2 px-2 badge bg-gradient-info text-white font-weight-bolder">Visible</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('vendor/product-re-store/' .$encrypted) }}" title="Restore" class="mr-1 badge badge-pill text-white px-2 py-1 bg-gradient-success">
                                                <i class="fas fa-trash-restore-alt"></i>
                                            </a>
                                            |
                                            <a href="{{ url('vendor/delete-product-trash/'.$encrypted) }}" title="Delete Trash" class="ml-1 badge badge-pill text-white px-2 py-1 bg-gradient-danger">
                                                <i class="fas fa-trash-alt"></i>
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

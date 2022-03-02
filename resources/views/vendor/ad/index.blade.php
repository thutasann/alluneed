@extends('layouts.vendor')

@include('layouts.inc.encrypt')

@section('title')
	Manage Ads
@endsection

@section('content')
    <div class="container-fluid mt-5">

        <div class="card mb-4 shadow-sm bg-gray-100 border-left-primary">
            <div class="card-body d-sm-flex align-items-center justify-content-between">
                <h6>
                    <a href="{{ url('/vendor-dashboard') }}">Vendor Dashboard</a>
                    <span><i class="fas fa-angle-right mx-1"></i></span>
                    <span>Manage Ads</span>
                </h6>
                <span>
                    <a href="{{ url('vendor/create-ads') }}" class='btn btn-sm bg-gradient-primary p-1 text-white'>
                        <i class="fas fa-plus-circle mr-1"></i>Create Ads
                    </a>
                </span>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-gray-600"> Ads Table</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class='table table-striped table-bordered' id='datatable'>

                                <thead>
                                    <th>ID</th>
                                    <th>Heading</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </thead>

                                <tbody>
                                    @foreach ($slider as $item)

                                        @php
                                            $encrypted = encrypt_decrypt('encrypt', $item->id);
                                        @endphp

                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->heading }}</td>
                                            <td>
                                                <img src="{{ asset('uploads/slider/'.$item->image)}}" alt="Slider Image" width="50px">
                                            </td>
                                            <td>
                                                @if ($item->status == '1')
                                                    <span class="py-2 px-2 badge bg-gradient-danger text-white font-weight-bolder">Hidden</span>
                                                @else
                                                    <span class="py-2 px-2 badge bg-gradient-info text-white font-weight-bolder">Visible</span>
                                                @endif
                                            </td>
                                            <td>{{ date('F j, Y',strtotime($item->created_at)) }}</td>
                                            <td>
                                                <a href="{{ url('v/ad-prods/'.$encrypted) }}" title="Add Products" class="badge badge-pill text-white mr-1 px-2 py-1 bg-gradient-warning">
                                                    <i class="fas fa-plus-circle"></i>
                                                </a>
                                                |
                                                <a href="{{ url('v/edit-ad/'.$encrypted) }}" title="Edit Ad" class="badge badge-pill text-white ml-1 px-2 py-1 bg-gradient-primary">
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

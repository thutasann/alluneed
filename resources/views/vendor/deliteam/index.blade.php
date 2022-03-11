@extends('layouts.vendor')

@include('layouts.inc.encrypt')


@section('title')
    Shipping Teams
@endsection

@section('content')
    <div class="container-fluid mt-5">

        <div class="card mb-4 shadow-sm bg-gray-100 border-left-primary">

            <div class="card-body d-sm-flex align-items-center justify-content-between">

                <h6>
                    <a href="{{ url("/vendor-dashboard") }}">Vendor Dashboard</a>
                    <span><i class="fas fa-angle-right mx-1"></i></span>
                    <a href="{{ url("/vendor/branches") }}">Manage Branches</a>
                    <span><i class="fas fa-angle-right mx-1"></i></span>
                    <span>Shipping Teams</span>
                </h6>

                <span>
                    <a href="{{ url('vendor/add-shipping-team') }}" class='btn btn-sm bg-gradient-primary p-1 text-white'>
                        <i class="fas fa-plus-circle mr-1"></i>Add
                    </a>
                </span>

            </div>

        </div>

        <div class='row'>
            <div class='col-md-12'>
                <div class='card shadow-sm mb-4'>

                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-gray-600">Shipping Teams Table</h6>
                        </div>

                        <div class='card-body'>

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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Schedule</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </thead>

                                    <tbody>
                                        @foreach ($deliteams as $item)

                                        @php
                                            $slname   = preg_replace('/[^a-z0-9]+/i', '_', trim(strtolower($item->name)));
                                            $encrypted = encrypt_decrypt('encrypt', $item->id);
                                        @endphp

                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td><a href='mailto:{{$item->email}}'>{{$item->email}}</a></td>
                                            <td><a href='tel:{{$item->phone}}'>{{$item->phone}}</a></td>
                                            <td>{{ $item->schedule }}</td>
                                            <td>
                                                @if ($item->status == '1')
                                                    <span class="py-2 px-2 badge bg-gradient-danger text-white font-weight-bolder">Unavailable</span>
                                                @else
                                                    <span class="py-2 px-2 badge bg-gradient-success text-white font-weight-bolder">Free</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('v/deli-team-edit/'.$encrypted.'/'.$slname )}}" title="Edit" class="badge badge-pill text-white px-2 py-1 mr-1 bg-gradient-primary">
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

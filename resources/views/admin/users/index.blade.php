@extends('layouts.admin')

@include('layouts.inc.encrypt')



@section('title')
	Manage Users
@endsection



@section('content')

    <div class="container-fluid mt-5">


        <div class="card mb-4 shadow-sm bg-gray-100 border-left-primary">
            <div class="card-body d-sm-flex align-items-center justify-content-between">
                <h6>
                    <a href="{{ url("/dashboard") }}">Dashboard</a>
                    <span><i class="fas fa-angle-right mx-1"></i></span>
                    <span>Manage Users</span>
                </h6>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-gray-600">Registered Users</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id='datatable'>
                                <thead>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Ban/Unban</th>
                                    <th>Action</th>
                                </thead>

                                <tbody>
                                    @foreach ($users as $item)

                                        @php
                                            $slname = preg_replace('/[^a-z0-9]+/i', '_', trim(strtolower($item->name)));
                                            $encrypted = encrypt_decrypt('encrypt', $item->id);
                                        @endphp

                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                @if($item->Image == NULL)
                                                <img style="margin-top: -8px; margin-bottom: -8px;" src="{{ asset('assets/img/avatar.png')}}" title="{{ $item->name }}" alt="{{ $item->name }}" width="50px">
                                                @else
                                                <img class="rounded-circle" src="{{ asset('uploads/profile/'.$item->Image)}}" title="{{ $item->name }}" alt="{{ $item->name }}" width="50px">
                                                @endif
                                            </td>
                                            <td><a href='mailto:{{$item->email}}'>{{$item->email}}</a></td>
                                            <td>
                                                @if($item->phone == '')
                                                ---
                                                @else
                                                <a href='tel:{{$item->phone}}'>{{$item->phone}}</a>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->role_as == 'admin')
                                                Admin
                                                @elseif($item->role_as == 'vendor')
                                                Vendor
                                                @elseif($item->role_as == '')
                                                User
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->isban == '0')
                                                    <label class="py-2 px-2 badge bg-gradient-info text-white font-weight-bolder">Unbanned</label>
                                                @elseif($item->isban == '1')
                                                    <label class="py-2 px-2 badge bg-gradient-danger text-white font-weight-bolder">Banned</label>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('role-edit/'.$encrypted.'/'.$slname ) }}" title="Role Edit" class="badge badge-pill text-white px-2 py-1 bg-gradient-primary">
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

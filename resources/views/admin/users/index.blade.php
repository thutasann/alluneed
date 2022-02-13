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
                    <a href="{{ url('/') }}">Dashboard</a>
                    <span><i class="fas fa-angle-right mx-1"></i></span>
                    <span>Manage Users</span>
                    <span>
                    @if(isset($_GET['roles']))
                        <span><i class="fas fa-angle-right mx-1"></i></span>
                        [
                        Showing Restult from
                        <strong class="text-primary">
                            @if(isset($_GET['roles']) === "")
                            users
                            @else
                            {{ $_GET['roles'] }}
                            @endif
                        </strong>
                        ]
                    @else
                    @endif
                    </span>
                </h6>

                @php $u_total = "0"; $ofu_total = "0"; @endphp
                @foreach($users_all as $item)
                @php
                    if($item->isUserOnline())
                    {
                    $u_total = $u_total +1;
                    }
                    else
                    {
                    $ofu_total = $ofu_total + 1;
                    }
                @endphp
                @endforeach

                @php $ban_total = 0; $unban_total = 0; @endphp

                @foreach($users_all as $item_b)
                @php
                    if($item_b->isban == '0')
                    {
                    $unban_total = $unban_total + 1;
                    }
                    elseif($item_b->isban == '1')
                    {
                    $ban_total = $ban_total + 1;
                    }
                @endphp
                @endforeach

                <span>
                <span class="py-2 px-2 badge bg-gradient-success text-white font-weight-bolder">Online Users : {{ $u_total }} </span>
                <span class="py-2 px-2 badge bg-gradient-warning text-white font-weight-bolder">Offline Users : {{ $ofu_total }} </span>
                <span class="py-2 px-2 badge bg-gradient-info text-white font-weight-bolder">Unbanned Users : {{ $unban_total }}</span>
                <span class="py-2 px-2 badge bg-gradient-danger text-white font-weight-bolder">Banned Users : {{ $ban_total }}</span>
                </span>

            </div>

        </div>

        <div class="row">

            <div class="col-12">
            <form action="{{ url('registered-user') }}" method="GET"  class="d-block mb-4">
                <div class="input-group">
                    <select name="roles" class="form-control shadow-none">
                    @if(isset($_GET['roles']))
                        <option value="{{ $_GET['roles'] }}">{{ $_GET['roles'] }}</option>
                        <option value="">users</option>
                        <option value="admin">admin</option>
                        <option value="vendor">vendor</option>
                    @else
                        <option value="">users</option>
                        <option value="admin">admin</option>
                        <option value="vendor">vendor</option>
                    @endif
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-primary shadow-none"type="submit" title="Filter">
                        <i class="fas fa-sliders-h"></i>
                        </button>
                        <span style="border-right: 0.2px solid #ddd;"></span>
                        <a href="{{ url('registered-user') }}" class="btn btn-primary shadow-none">
                        All
                        </a>
                    </div>
                </div>
            </form>
            </div>

            <div class="col-md-12">
            <div class="card shadow-sm mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-gray-600">Users Table</h6>
                </div>

                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id='datatable' >

                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Ban/Unban</th>
                        <th>Action</th>
                    </thead>

                    <tbody>

                        @if(isset($_GET['roles']))

                        @foreach ($users as $item)
                            @php
                                $slname = preg_replace('/[^a-z0-9]+/i', '_', trim(strtolower($item->name)));
                                $encrypted = encrypt_decrypt('encrypt', $item->id);
                            @endphp

                            <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
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
                                <!-- from user.php -->
                                @if($item->isUserOnline())
                                <label class="py-2 px-2 badge bg-gradient-success text-white font-weight-bolder">Online</label>
                                @else
                                <label class="py-2 px-2 badge bg-gradient-warning text-white font-weight-bolder">Offline</label>
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

                        @else

                        @foreach ($users_all as $item)
                            @php
                                $slname = preg_replace('/[^a-z0-9]+/i', '_', trim(strtolower($item->name)));
                                $encrypted = encrypt_decrypt('encrypt', $item->id);
                            @endphp

                            <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
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
                                <!-- from user.php -->
                                @if($item->isUserOnline())
                                <label class="py-2 px-2 badge bg-gradient-success text-white font-weight-bolder">Online</label>
                                @else
                                <label class="py-2 px-2 badge bg-gradient-warning text-white font-weight-bolder">Offline</label>
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

                        @endif

                    </tbody>

                    </table>
                </div>
                </div>

            </div>
            </div>

        </div>

    </div>

@endsection

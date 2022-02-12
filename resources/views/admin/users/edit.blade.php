@extends('layouts.admin')

@section('title')
	User Role Edit
@endsection

@section('content')
    <div class="container-fluid mt-5">

        <div class="card mb-4 shadow-sm bg-gray-100 border-left-primary">
            <div class="card-body d-sm-flex align-items-center justify-content-between">
                <h6>
                    <a href="{{ url('/registered-user') }}">Registered Users</a>
                    <span><i class="fas fa-angle-right mx-1"></i></span>
                    <span>User Role Edit</span>
                </h6>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-none mb-4">

                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                                {{session('status')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="d-flex mb-3 border-bottom pb-2" style="justify-content: space-between;">
                            <div>
                                <h6>Current Role :
                                    <strong class="text-primary">
                                    @if($user_roles->role_as == 'admin')
                                        <span class="py-2 px-2 badge bg-gradient-primary text-white font-weight-bolder">Admin</span>
                                    @elseif($user_roles->role_as == 'vendor')
                                        <span class="py-2 px-2 badge bg-gradient-primary text-white font-weight-bolder">Vendor</span>
                                    @elseif($user_roles->role_as == '')
                                        <span class="py-2 px-2 badge bg-gradient-primary text-white font-weight-bolder">Users</span>
                                    @endif
                                </strong>
                                </h6>
                            </div>
                            <div>
                                @if($user_roles->isban == '0')
                                Ban Status : <span class="py-2 px-2 badge bg-gradient-primary text-white font-weight-bolder">Unbanned User</span>
                                @elseif($user_roles->isban == '1')
                                Ban Status : <span class="py-2 px-2 badge bg-gradient-danger text-white font-weight-bolder">banned User</span>
                                @endif
                            </div>
                        </div>

                        <form action="{{ url('role-update/'.$user_roles->id) }}" method="POST" class='mt-4'>

                            {{ csrf_field() }}
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control bg-white" value="{{ $user_roles->name }}" readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control bg-white" value="{{ $user_roles->email }}" readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Role</label>
                                            <select name="roles" class="form-control">

                                            @if($user_roles->role_as == '')
                                                <option value="">User</option>
                                            @elseif($user_roles->role_as == 'admin')
                                                <option value="{{ $user_roles->role_as }}">Admin</option>
                                            @elseif($user_roles->role_as == 'vendor')
                                                <option value="{{ $user_roles->role_as }}">Vendor</option>
                                            @endif

                                            <option value="">User</option>
                                            <option value="admin">Admin</option>
                                            <option value="vendor">Vendor</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ban / UnBan</label>
                                            <select name="isban" class="form-control">

                                            @if($user_roles->isban == '0')
                                                <option value="0">Unban</option>
                                            @elseif($user_roles->isban == '1')
                                                <option value="1">Ban</option>
                                            @endif
                                            <option value="1">Bann</option>
                                            <option value="0">Unban</option>

                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="row row my-4 mx-1">
                                <div class='col-md-12 pro-change'>

                                    <div class="preview">
                                        @if($user_roles->Image == NULL)
                                            <img id='preview-user' src="{{ asset('assets/img/avatar.png')}}" title="{{ $user_roles->name }}" alt="{{ $user_roles->name }}">
                                        @else
                                            <img id='preview-user' src="{{ asset('uploads/profile/'.$user_roles->Image)}}" title="{{ $user_roles->name }}" alt="{{ $user_roles->name }}">
                                        @endif
                                    </div>

                                    <div id="myModal-user" class="modal-img">
                                        <span class="close-user">&times;</span>
                                        <img class="modal-content-img" id="img01-user">
                                        <div id="caption-user"></div>
                                    </div>

                                </div>
                            </div>

                            <div class="row my-4">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Update User</button>
                                        <button type='reset' class='btn btn-secondary'>Cancel</button>
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

@section('scripts')

    <script>
        // user (from edit role [Admin Dashboard])
        var modal_user = document.getElementById("myModal-user");
        var user = document.getElementById("preview-user");
        var modalUser = document.getElementById("img01-user");
        var captionText_user = document.getElementById("caption-user");

        user.onclick = function () {
            modal_user.style.display = "block";
            modalUser.src = this.src;
            captionText_user.innerHTML = this.alt;
        }

        var span_user = document.getElementsByClassName("close-user")[0];

        span_user.onclick = function () {
            modal_user.style.display = "none";
        }
    </script>

@endsection

@extends('layouts.admin')

@section('title')
	Role Edit
@endsection

@section('content')
  <div class="container-fluid mt-5">

      <!-- Heading -->
      <div class="card mb-4 wow fadeIn">
        <div class="card-body d-sm-flex justify-content-between">
          <h4 class="mb-2 mb-sm-0 pt-1">
            <span>Registered Users - Edit Role</span>
          </h4>
        </div>
      </div>
  
      <!--Grid row-->
      <div class="row wow fadeIn">

        <div class="col-md-12 mb-4">
          <div class="card">
            <div class="card-header">
                Edit
            </div>

            <div class="card-body"> 
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <h4 class='mb-4 text-primary'>Current Role: {{ $user_roles->role_as }}</h4>

                @if($user_roles->isban == '0')
                  Ban Status : <label class="py-2 px-3 badge btn-primary">Unbanned User</label>
                @elseif($user_roles->isban == '1')
                  Ban Status : <label class="py-2 px-3 badge btn-danger">banned User</label>
                @endif

                <form action="{{ url('role-update/'.$user_roles->id) }}" method="POST" class='mt-4'>

                    {{ csrf_field() }}

                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />

                    <div class="form-group">
                        <input type="text" name="name" class="form-control" value="{{ $user_roles->name }}">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control bg-white" value="{{ $user_roles->email }}" readonly>
                    </div>
                    <div class="form-group">
                        <select name="roles" class="form-control">
                                <option value="">--Select Roles---</option>
                                <option value="">Default</option>
                                <option value="admin">Admin</option>
                                <option value="vendor">Vendor</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="isban" class="form-control">
                                <option value="">--Select Ban or Unban---</option>
                                <option value="1">Bann Now</option>
                                <option value="0">Unban Now</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
      
      </div>

    </div>
@endsection
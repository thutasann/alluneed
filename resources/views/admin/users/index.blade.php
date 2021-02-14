@extends('layouts.admin')

@section('title')
	Registered Users
@endsection


@section('content')
  <div class="container-fluid mt-5">

      <div class="card mb-4 wow fadeIn">
        <div class="card-body d-sm-flex justify-content-between">
          <h5 class="mb-2 mb-sm-0 pt-1">
            <a href="/dashboard" target="_blank">Home</a> <span>/</span> <span>Registered Users</span>
          </h5>
        </div>
      </div>
  
      <!--Grid row-->
      <div class="row wow fadeIn">
        <div class="col-md-6">
           <form action="{{ url('registered-user') }}" method="GET">
              <div class='row'>
                  <div class='col-md-8'>
                      <div class='form-group'>
                         <select name="roles" class="form-control">
                            @if(isset($_GET['roles']))
                              <option value="{{ $_GET['roles'] }}">{{ $_GET['roles'] }}</option>
                              <option value="">Default</option>
                              <option value="admin">admin</option>
                              <option value="vendor">vendor</option>
                            @else
                              <option value="">Default</option>
                              <option value="admin">admin</option>
                              <option value="vendor">vendor</option>
                            @endif
                         </select>
                      </div>
                  </div>
                  <div class='col-md-4'>
                    <div class='form-group'>
                      <button type='submit' class='btn btn-primary py-2'>Filter</button>
                    </div>
                  </div>
              </div>
           </form>
        </div>
        
        <!-- total online user -->
        <div class="col-md-6">
                <h5 class="badge btn-success w-100 h-50">
                  @php $u_totoal= "0"; @endphp
                  @foreach($users as $item)
                      @php
                        if($item->isUserOnline())
                        {
                          $u_totoal = $u_totoal +1;
                        }
                      @endphp
                  @endforeach
                  <span style='font-size:1rem;'>Online Users : {{ $u_totoal }}</span>
                </h5>
        </div>

        <div class="col-md-12">
          <div class="card">
            <div class="card-body" style="overflow-y:auto;">  
              <table class="table table-bordered table-striped" id='datatable' >
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th class='text-center'>Online/Offline</th>
                      <th class='text-center'>Ban/Unban</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    @foreach ($users as $item)
                    @php 
                        $slname = preg_replace('/[^a-z0-9]+/i', '_', trim(strtolower($item->name)));
                    @endphp

                    <tr>
                      <td>{{ $item-> id}}</td>
                      <td>{{ $item-> name}}</td>
                      <td>{{ $item-> email}}</td>
                      <td>{{ $item-> role_as}}</td>

                      <td>
                        <!-- from user.php -->
                        @if($item->isUserOnline())
                          <label class="py-2 px-3 badge btn-success">Online</label>
                        @else
                          <label class="py-2 px-3 badge btn-warning">Offline</label>
                        @endif
                      </td>

                      <td class='text-center'>
                        @if($item->isban == '0')
                            <label class="py-2 px-3 badge btn-primary">Not banned</label>
                        @elseif($item->isban == '1')
                            <label class="py-2 px-3 badge btn-danger">banned</label>
                        @endif
                      </td>

                      <td>
                        <a href="{{ url('role-edit/' .Crypt::encrypt($item->id).'/'.$slname ) }}" class="badge badge-pill btn-primary px-3 py-2 mb-2">EDIT</a>
                        <a href="" class="badge badge-pill btn-danger px-3 py-2">DELETE</a>
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
@endsection

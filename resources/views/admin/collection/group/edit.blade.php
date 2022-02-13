@extends('layouts.admin')

@section('title')
	Group Edit
@endsection

@section('content')
    <div class="container-fluid mt-5">

        <div class="card mb-4 shadow-sm bg-gray-100 border-left-primary">
            <div class="card-body d-sm-flex align-items-center justify-content-between">
                <h6>
                    <a href="{{ url('/groups') }}">Groups</a>
                    <span><i class="fas fa-angle-right mx-1"></i></span>
                    <span>Group Edit</span>
                </h6>
                <span>
                    <a href="{{ url('group-add') }}" class='btn btn-sm bg-gradient-primary p-1 text-white'>
                        <i class="fas fa-plus-circle mr-1"></i>Add
                    </a>
                </span>
            </div>
        </div>

        <div class='row'>
            <div class='col-md-12'>
               <div class='card shadow-sm mb-4'>
                    <div class='card-body'>
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{session('status')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <form action="{{ url('group-update/' .$group->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class='row'>
                                <div class='col-md-12'>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" id="name" name="name" class='form-control' value='{{ $group->name }}' placeholder="Enter Name" required>
                                    </div>
                                </div>

                                <div class='col-md-12'>
                                    <div class="form-group">
                                        <label>Custom URL</label>
                                        <input type="text" id="url" name="url" class='form-control bg-white' placeholder='Enter URL' value='{{ $group->url }}' readonly>
                                    </div>
                                </div>

                                <div class='col-md-12'>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control" name="descrip" rows="4" required>{{ $group->descrip }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class='form-check form-check-inline form-group'>
                                        <label class="form-check-label">Status</label> &nbsp;
                                        <input class="form-check-input" name="status" type="checkbox" {{$group->status=='1' ? 'checked' : ''}}>
                                        <small class='ml-2'><i>( If you check this checkbox, this will be hidden on our website )</i></small>
                                    </div>
                                </div>

                                <div class="col-md-12 my-4">
                                    <div class='form-group'>
                                        <button type='submit' class='btn btn-primary text-white'>Update Group</button>
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


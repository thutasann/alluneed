@extends('layouts.admin')

@section('title')
	Group Add
@endsection

@section('content')
    <div class="container-fluid mt-5">

        <div class="card mb-4 shadow-sm bg-gray-100 border-left-primary">

            <div class="card-body d-sm-flex align-items-center justify-content-between">

                <h6>
                    <a href="{{ url('groups')}}">Groups</a>
                    <span><i class="fas fa-angle-right mx-1"></i></span>
                    <span>Group Add</span>
                </h6>

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

                            <form action="{{ url('group-store') }}" method="POST">
                                {{ csrf_field() }}

                                <div class='row'>
                                    <div class='col-md-12'>
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" id="name" name="name" class='form-control' placeholder='Enter Name' required>
                                        </div>
                                    </div>

                                    <div class='col-md-12'>
                                        <div class="form-group">
                                            <label>Custom URL</label>
                                            <input type="text" id="url" name="url" class='form-control bg-white' placeholder='Custom URL' readonly>
                                        </div>
                                    </div>

                                    <div class='col-md-12'>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" name="descrip" rows="4" placeholder='Enter Description' required></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class='form-check form-check-inline form-group'>
                                            <label class="form-check-label">Status</label> &nbsp;
                                            <input class="form-check-input" name="status" type="checkbox">
                                            <small class='text-dark ml-2'><i>( If you check this checkbox, this will be hidden on our website )</i></small>
                                        </div>
                                    </div>

                                    <div class="col-md-12 my-4">
                                        <div class='form-group'>
                                            <button type='submit' class='btn btn-primary'>Add Group</button>
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

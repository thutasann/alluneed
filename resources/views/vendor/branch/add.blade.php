@extends('layouts.vendor')

@section('title')
	Add Branch
@endsection

@section('content')
    <div class="container-fluid mt-5">

        <div class="card mb-4 shadow-sm bg-gray-100 border-left-primary">

            <div class="card-body d-sm-flex align-items-center justify-content-between">

                <h6>
                    <a href="{{ url('vendor/branches')}}">Branches</a>
                    <span><i class="fas fa-angle-right mx-1"></i></span>
                    <span>Add Branch</span>
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

                            <form action="{{ url('vendor/branch-store') }}" method="POST">
                                {{ csrf_field() }}
                                <div class='row'>
                                    <div class='col-md-12'>
                                        <div class="form-group">
                                            <label>Branch Name</label>
                                            <input type="text" id="name" name="name" class='form-control' placeholder='Enter Branch Name' required>
                                        </div>
                                    </div>

                                    <div class='col-md-6'>
                                        <div class="form-group">
                                            <label>Country (Type '@')</label>
                                            <input type="text" name="country" id="form-autocomplete-country" class='form-control' placeholder='Enter Country' required>
                                        </div>
                                    </div>

                                    <div class='col-md-6'>
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" name="city" class='form-control' placeholder='Enter City' required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Open or Close</label>
                                            <select name="status" class="form-control">
                                                <option value="0">Open</option>
                                                <option value="1">Close</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12 my-4">
                                        <div class='form-group'>
                                            <button type='submit' class='btn btn-primary'>Add Branch</button>
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

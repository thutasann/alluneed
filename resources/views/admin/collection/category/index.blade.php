@extends('layouts.admin')

@include('layouts.inc.encrypt')

@section('title')
	Categories
@endsection

@section('content')
    <div class="container-fluid mt-5">

        <div class="card mb-4 shadow-sm bg-gray-100 border-left-primary">

            <div class="card-body d-sm-flex align-items-center justify-content-between">

                <h6>
                    <a href="{{ url('/groups') }}">Collections</a>
                    <span><i class="fas fa-angle-right mx-1"></i></span>
                    <span>Categories</span>
                </h6>

                <span>
                    <a href="{{ url('category-add') }}" class='btn btn-sm bg-gradient-primary p-1 text-white'>
                        <i class="fas fa-plus-circle mr-1"></i>Add
                    </a>
                    <a href="{{ url('category-deleted-records') }}" class='btn btn-sm bg-gradient-danger p-1 text-white'>
                        <i class="fas fa-trash-alt mr-1"></i>Trash ( {{ count($trash) }} )
                    </a>
                </span>

            </div>

        </div>

        <div class='row'>
            <div class='col-md-12'>
                <div class='card shadow-sm mb-4'>
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-gray-600">Categories Table</h6>
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
                                    <th>Group</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Icon</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </thead>

                                <tbody>
                                    @foreach ($category as $item)

                                        @php
                                            $slname   = preg_replace('/[^a-z0-9]+/i', '_', trim(strtolower($item->name)));
                                            $encrypted = encrypt_decrypt('encrypt', $item->id);
                                            $cutdesc  = substr($item->description,0,30);
                                        @endphp

                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->group->name }}</td>
                                            <td>{{ $cutdesc }}...</td>
                                            <td>
                                                <img src="{{ asset('uploads/categoryimage/'.$item->image)}}" alt="Category Image" width="50px">
                                            </td>
                                            <td>
                                                <img src="{{ asset('uploads/categoryicon/'.$item->icon)}}" alt="Category Icon" width="50px">
                                            </td>
                                            <td>
                                                @if ($item->status == '1')
                                                    <span class="py-2 px-2 badge bg-gradient-danger text-white font-weight-bolder">Hidden</span>
                                                @else
                                                    <span class="py-2 px-2 badge bg-gradient-info text-white font-weight-bolder">Visible</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('category-edit/'.$encrypted.'/'.$slname )}}" title="Edit" class="mr-1 badge badge-pill text-white px-2 py-1 bg-gradient-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                |
                                                <a href="{{ url('category-delete/'.$encrypted) }}" title="Trash" class="ml-1 badge badge-pill text-white px-2 py-1 bg-gradient-danger">
                                                    <i class="fas fa-trash-alt"></i>
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

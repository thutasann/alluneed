@extends('layouts.admin')

@include('layouts.inc.encrypt')

@section('title')
	Trash Categories
@endsection

@section('content')
    <div class="container-fluid mt-5">
        
        <div class="card mb-4 shadow-sm bg-gray-100 border-left-primary">
            <div class="card-body d-sm-flex align-items-center justify-content-between">
                <h6>
                    <a href="{{ url('category')}}">Categories</a> 
                    <span><i class="fas fa-angle-right mx-1"></i></span> 
                    <span>Trash</span>
                </h6>
                <span>
                    @if(count($category) == 0)
                    @else
                        <a href="{{ url('empty-category-trash') }}" class='btn btn-sm bg-gradient-danger p-1 text-white'>
                            <i class="far fa-trash-alt mr-1"></i>Empty Trash
                        </a>
                    @endif
                </span>
            </div>
        </div>

        <div class='row'>
            <div class='col-md-12'>
               <div class='card shadow-sm mb-4'>
                   
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-gray-600">Category Trash Table</h6>
                    </div>

                    <div class='card-body'>

                        @if (session('del-trash-status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{session('del-trash-status')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if (session('empty-trash-status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{session('empty-trash-status')}}
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
                                                <a href="{{ url('category-re-store/' .$encrypted) }}" title="Restore" class="mr-1 badge badge-pill text-white px-2 py-1 bg-gradient-success">
                                                    <i class="fas fa-trash-restore-alt"></i>
                                                </a>
                                                |
                                                <a href="{{ url('delete-category-trash/'.$encrypted) }}" title="Delete Trash" class="ml-1 badge badge-pill text-white px-2 py-1 bg-gradient-danger">
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
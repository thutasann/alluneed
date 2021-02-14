@extends('layouts.admin')

@include('layouts.inc.encrypt')

@section('title')
	Deleted Categories
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
            </div>
        </div>

        <div class='row'>
            <div class='col-md-12'>
               <div class='card shadow-sm mb-4'>
                   
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-gray-600">Category Trash Table</h6>
                    </div>

                    <div class='card-body'>
                        <div class="table-responsive">
                            <table class='table table-striped table-bordered' id='datatable'>
                                
                                <thead>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>GroupName</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Icon</th>
                                    <th>Show/Hide</th>
                                    <th>Action</th>
                                </thead>

                                <tbody>
                                    @foreach ($category as $item)

                                    @php 
                                        $encrypted = encrypt_decrypt('encrypt', $item->id);
                                        $cutdesc  = substr($item->description,0,50);
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
                                            <input type="checkbox" {{ $item->status == '1' ? 'checked' : '' }} >
                                        </td>
                                        <td>
                                            <a href="{{ url('category-re-store/' .$encrypted) }}" class="badge badge-pill text-white px-2 py-1 bg-gradient-success">Re-store</a>
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
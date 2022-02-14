@extends('layouts.admin')

@include('layouts.inc.encrypt')

@section('title')
	Sub Category
@endsection

@section('content')


    @include('admin.collection.subcategory.uploadmodal')

    <div class="container-fluid mt-5">

        <div class="card mb-4 shadow-sm bg-gray-100 border-left-primary">
            <div class="card-body d-sm-flex align-items-center justify-content-between">
                <h6>
                    <a href="{{ url('/groups') }}">Collections</a>
                    <span><i class="fas fa-angle-right mx-1"></i></span>
                    <span>Sub Categories (Brands)</span>
                </h6>
                <span>
                    <a href="#subcatgory-add" class='btn btn-sm bg-gradient-primary p-1 text-white buttonsubs'>
                        <i class="fas fa-plus-circle mr-1"></i>Add
                    </a>
                    <a href="{{ url('subcategory-deleted-records') }}" class='btn btn-sm bg-gradient-danger p-1 text-white'>
                        <i class="fas fa-trash-alt mr-1"></i>Trash ({{ count($trash) }})
                    </a>
                </span>
            </div>
        </div>

        <div class='row'>
            <div class='col-md-12'>
               <div class='card shadow-sm mb-4'>

                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-gray-600">Sub Categories (Brand) Table</h6>
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

                        @if (session('status-img'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{session('status-img')}}
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
                                    <th>Category</th>
                                    <th>Group</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </thead>

                                <tbody>
                                    @foreach ($subcategory as $item)

                                        @php
                                            $slname   = preg_replace('/[^a-z0-9]+/i', '_', trim(strtolower($item->name)));
                                            $encrypted = encrypt_decrypt('encrypt', $item->id);
                                            $cutdesc  = substr($item->description,0,50);
                                        @endphp

                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->category->name}}</td>
                                            <td>{{ $item->category->group->name}}</td>
                                            <td>{{ $cutdesc }}... </td>

                                            <td>
                                                <img src="{{ asset('uploads/subcategoryimage/'.$item->image)}}" alt="Sub Category Image" width="50px">
                                            </td>

                                            <td>
                                                @if ($item->status == '1')
                                                    <span class="py-2 px-2 badge bg-gradient-danger text-white font-weight-bolder">Hidden</span>
                                                @else
                                                    <span class="py-2 px-2 badge bg-gradient-info text-white font-weight-bolder">Visible</span>
                                                @endif
                                            </td>

                                            <td>
                                                <a href="{{ url('sub-category-edit/'.$encrypted.'/'.$slname )}}" title="Edit" class="mr-1 badge badge-pill text-white px-2 py-1 bg-gradient-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ url('sub-category-delete/'.$encrypted) }}" title="Trash" class=" badge badge-pill text-white px-2 py-1 bg-gradient-danger">
                                                    <i class="fas fa-trash"></i>
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

@section('scripts')

  {{-- custom file upload --}}
  <script type="text/javascript" src="{{ asset('assets/js/customfile.js') }}"></script>

@endsection

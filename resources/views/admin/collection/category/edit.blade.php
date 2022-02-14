@extends('layouts.admin')

@section('title')
	Category Edit
@endsection

@section('content')
    <div class="container-fluid mt-5">
        
        <div class="card mb-4 shadow-sm bg-gray-100 border-left-primary">
            <div class="card-body d-sm-flex align-items-center justify-content-between">
                <h6>
                    <a href="{{ url('category') }}">Category</a> 
                    <span><i class="fas fa-angle-right mx-1"></i></span> 
                    <span>Category Edit</span>
                </h6>
                <span>
                    <a href="{{ url('category-add') }}" class='btn btn-sm bg-gradient-primary p-1 text-white'>
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

                        <form action="{{ url('category-update/'.$category->id) }}" method="POST" enctype="multipart/form-data">

                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class='row'>

                                <div class='col-md-6'>
                                    <div class="form-group">
                                        <label>Group</label>
                                        <select name="group_id" class="form-control" required>
                                            <option value="{{ $category->group_id}}">{{$category->group->name}}</option>
                                            @foreach($group as $gitem)
                                                <option value="{{ $gitem->id }}">{{ $gitem->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class='col-md-6'>
                                    <div class="form-group">
                                        <label>Category Name</label>
                                        <input type="text" id="name" name="name" class='form-control' value='{{$category->name}}' placeholder='Enter Name' required>
                                    </div>
                                </div>

                                <div class='col-md-6'>
                                    <div class="form-group">
                                        <label>Custom URL</label>
                                        <input type="text" id="url" name="url" class='form-control bg-white' value='{{$category->url}}' placeholder='Enter URL' readonly>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class='form-check form-check-inline form-group mt-4 pt-2'>
                                        <label class="form-check-label">Status</label> &nbsp;
                                        <input class="form-check-input" name="status" type="checkbox" {{$category->status == '1'? 'checked' : ''}} >
                                        <small class='text-dark ml-2'><i>( If you check this checkbox, this will be hidden on our website )</i></small>
                                    </div>
                                </div>

                                <div class='col-md-12'>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control" name="description" rows="4" placeholder='Enter Description' required>{{$category->description}} 
                                        </textarea>
                                    </div>
                                </div>
                            
                            </div>

                            <div class="row row my-4 mx-1">

                                <div class='col-md-6 pro-change'>

                                    <div class="preview"> 
                                        <img id='img-preview' src="{{ asset('uploads/categoryimage/'.$category->image)}}" alt="{{ $category->name }} Image">
                                    </div>

                                    <!-- Modal Image -->
                                    <div id="myModal-img" class="modal-img">
                                        <span class="close-img">&times;</span>
                                        <img class="modal-content-img" id="img01">
                                        <div id="caption-img"></div>
                                    </div>


                                    <button id="triggerUpload" class="btn-choose-img" type='button' title="Choose Image">
                                        Choose Image   
                                    </button>

                                    <input type="file" id="filePicker" name="category_img" class='prochange-input'>
                                    <div class="fileName"></div>

                                </div>

                                <div class='col-md-6 pro-change'>

                                    <div class="preview-icon"> 
                                        <img id='icon-preview' src="{{ asset('uploads/categoryicon/'.$category->icon)}}"  alt="{{ $category->name }} Icon" >
                                    </div>

                                    <!-- Modal Icon -->
                                    <div id="myModal-icon" class="modal-img">
                                        <span class="close-icon">&times;</span>
                                        <img class="modal-content-img" id="img02">
                                        <div id="caption-icon"></div>
                                    </div>

                                    <button id="triggerUpload-icon" class="btn-choose-img" type='button' title="Choose Icon">
                                        Choose Icon
                                    </button>

                                    <input type="file" id="filePicker-icon" name="category_icon" class='prochange-input'>
                                    <div class="fileName-icon"></div>

                                </div>

                            </div>
                            
                            <div class="row my-4">
                                <div class="col-md-12">
                                    <div class='form-group'>
                                        <button type='submit' class='btn btn-primary'>Update Category</button>
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

  {{-- custom file upload --}}
  <script type="text/javascript" src="{{ asset('assets/js/customfile.js') }}"></script>

@endsection

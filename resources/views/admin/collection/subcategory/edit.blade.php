@extends('layouts.admin')

@section('title')
	Sub Category Edit
@endsection

@section('content')
    <div class="container-fluid mt-5">
        
        <div class="card mb-4 shadow-sm bg-gray-100 border-left-primary">
            <div class="card-body d-sm-flex align-items-center justify-content-between">
                <h6>
                    <a href="{{ url('sub-category') }}">Sub Category</a> 
                    <span><i class="fas fa-angle-right mx-1"></i></span> 
                    <span>Sub-Category Edit</span>
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

                        <form action="{{ url('sub-category-update/'.$subcategory->id) }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                                    
                            <div class='row'>
                                
                                <div class='col-md-6'>
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select name="category_id" class="form-control" required>
                                            <option value="{{$subcategory->category->id}}">{{$subcategory->category->name}}</option>
                                            @foreach($category as $cateitem)
                                                <option value="{{ $cateitem->id }}">{{ $cateitem->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class='col-md-6'>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" id="name" name="name" value='{{$subcategory->name}}' class='form-control' placeholder='Enter Name' required>
                                    </div>
                                </div>

                                <div class='col-md-6'>
                                    <div class="form-group">
                                        <label>Custom URL</label>
                                        <input type="text" id="url" name="url" class='form-control' value='{{$subcategory->url}}' placeholder='Enter URL'>
                                    </div>
                                </div>

                                <div class='col-md-6'>
                                    <div class="form-group">
                                        <label>Priority</label>
                                        <input type="number" name="priority" value='{{$subcategory->priority}}' class='form-control' placeholder='Enter Priority' required>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-2">
                                    <div class='form-check form-check-inline form-group pt-2'>
                                        <label class="form-check-label">Show / Hide</label> &nbsp;
                                        <input class="form-check-input" name="status" type="checkbox" {{$subcategory->status == '1'? 'checked' : ''}} >
                                        <small class='text-dark ml-2'><i>( If you check this checkbox, this will be hidden on our website )</i></small>
                                    </div>
                                </div>

                                <div class='col-md-12'>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control" name="description" rows="4" placeholder='Enter Description' required>{{$subcategory->description}}</textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="row mx-1">

                                <div class='col-md-12 pro-change'>

                                    <div class="preview"> 
                                        <img id='img-preview' src="{{ asset('uploads/subcategoryimage/'.$subcategory->image) }}" alt="{{$subcategory->name}} Image">
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

                                    <input type="file" id="filePicker" name="image" class='prochange-input'>
                                    <div class="fileName"></div>

                                </div>

                            </div>

                            <div class="row my-4">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type='submit' class='btn btn-primary'>Update Sub Category (Brand)</button>
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
  
  <script>
        $(document).ready(function () {

            var modal = document.getElementById("myModal-img");
            var img = document.getElementById("img-preview");
            var modalImg = document.getElementById("img01");
            var captionText = document.getElementById("caption-img");

            img.onclick = function () {
                modal.style.display = "block";
                modalImg.src = this.src;
                captionText.innerHTML = this.alt;
            }

            var span = document.getElementsByClassName("close-img")[0];

            span.onclick = function () {
                modal.style.display = "none";
            }

        });
  </script>
    
@endsection
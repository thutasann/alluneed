@extends('layouts.vendor')

@section('title')
	Create Ads
@endsection

@section('content')
    <div class="container-fluid mt-5">

        <div class="card mb-4 shadow-sm bg-gray-100 border-left-primary">
            <div class="card-body d-sm-flex align-items-center justify-content-between">
                <h6>
                    <a href="{{ url('vendor/manage-ads') }}">Manage Ads</a>
                    <span><i class="fas fa-angle-right mx-1"></i></span>
                    <span>Create Ads</span>
                </h6>
                <div>
                    Date : <b class="text-primary">{{ Carbon\Carbon::now()->format('m/d/Y') }}</b>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{session('status')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <form action="{{ url('vendor/store-ad') }}" method="POST" enctype="multipart/form-data">

                            {{ csrf_field() }}

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Heading</label>
                                        <input type="text" id="name" name="heading" class='form-control' placeholder='Enter Heading' required>
                                        <input type="hidden" name="vendor_id" value="{{ Auth::user()->id }}" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Link</label>
                                        <input type="text" id="url" name="link" class='form-control bg-white' placeholder='Enter Link' readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Link Name (Read More, Explore More, etc.)</label>
                                        <input type="text" id="link_name" name="link_name" class='form-control' placeholder='Enter Link Name '>
                                    </div>
                                </div>

                                <div class="col-md-6 pt-1">
                                    <div class='form-check form-check-inline form-group mt-4'>
                                        <label class="form-check-label" for="">Status</label> &nbsp;
                                        <input class="form-check-input" name="status" id="status" type="checkbox">
                                    </div>
                                    <small class='text-dark'><i>( If you check this checkbox, this will be hidden on our website )</i></small>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Description (Optional)</label>
                                        <textarea class="form-control" name="description" id="description" rows="4" placeholder='Enter Description'></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="file-upload my-3">

                                        <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">
                                            Upload Image
                                        </button>

                                        <div class="image-upload-wrap">
                                            <input class="file-upload-input" type='file' name="slider_image" onchange="readURL(this);" accept="image/*" />
                                            <div class="drag-text">
                                                <h3>Drag and drop a file or select add Image (1280 x 720)</h3>
                                            </div>
                                        </div>

                                        <div class="file-upload-content">
                                            <img class="file-upload-image" src="#" alt="your image" />
                                            <div class="image-title-wrap">
                                            <button type="button" onclick="removeUpload()" class="remove-image">
                                                Remove <span class="image-title">Uploaded Image</span>
                                            </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12 my-4">
                                    <div class='form-group'>
                                        <button type='submit' class='btn btn-primary'>Create Ad</button>
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

<script type="text/javascript" src="{{ asset('assets/js/customfile-ad.js') }} "></script>

@endsection

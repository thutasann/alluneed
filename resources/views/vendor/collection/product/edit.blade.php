@extends('layouts.vendor')

@section('title')
	Product Edit
@endsection

@section('content')
    <div class="container-fluid mt-5">

        <div class="card mb-4 shadow-sm bg-gray-100 border-left-primary">
            <div class="card-body d-sm-flex align-items-center justify-content-between">
                <h6>
                    <a href="{{ url('/vendor/products')}}">Products</a>
                    <span><i class="fas fa-angle-right mx-1"></i></span>
                    <span>Product Edit</span>
                </h6>
                <span>
                    <a href="{{ url('vendor/add-products') }}" class='btn btn-sm bg-gradient-primary p-1 text-white'>
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

                        {{-- error msgs (7) --}}

                        @if (session('status_name'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{session('status_name')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if (session('status_url'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{session('status_url')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if (session('status_brand'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{session('status_brand')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if (session('status_orprice'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{session('status_orprice')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if (session('status_qty'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{session('status_qty')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if (session('status_priority'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{session('status_priority')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if (session('status_meta'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{session('status_meta')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <form action="{{ url('vendor/update-product/'.$products->id) }}" method="POST" enctype="multipart/form-data" spellcheck="false">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="product-tab" data-toggle="tab" href="#product" role="tab">Product</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="image-tab" data-toggle="tab" href="#image" role="tab">Images</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="descriptions-tab" data-toggle="tab" href="#descriptions" role="tab">Description</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="seo-tab" data-toggle="tab" href="#seo" role="tab">SEO</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="status-tab" data-toggle="tab" href="#status" role="tab">Product Status</a>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent">

                                <!-- product tab required(7) -->
                                <div class="tab-pane fade show active" id="product" role="tabpanel">

                                    <div class='row mt-4'>

                                        {{-- name required --}}
                                        <div class='col-md-6'>
                                            <div class="form-group">
                                                <label>Product Name</label>
                                                <input type="text" id="name" name="name" class='form-control' value="{{$products->name}}" placeholder='Product Name' required>
                                            </div>
                                        </div>

                                        {{-- url required --}}
                                        <div class='col-md-6'>
                                            <div class="form-group">
                                                <label>Custom URL</label>
                                                <input type="text" id="url" name="url" class='form-control bg-white' value="{{$products->url}}" placeholder='Custom URL' required>
                                            </div>
                                        </div>

                                        {{-- choose brand required --}}
                                        <div class='col-md-6'>
                                            <div class="form-group">
                                                <label>Sub Category ID (Sub Category Name)</label>
                                                <select name="sub_category_id" class="form-control" required>
                                                    <option value="{{$products->subcategory->id}}">{{$products->subcategory->name}}</option>
                                                    @foreach($subcategory as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        {{-- sale tag --}}
                                        <div class='col-md-6'>
                                            <div class="form-group">
                                                <label>Sale Tag (Optional)</label>
                                                <input type="text" name="sale_tag" class='form-control' value="{{$products->sale_tag}}" placeholder='Sale Tag'>
                                            </div>
                                        </div>

                                        {{-- small desc --}}
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Small Description (Optional)</label>
                                                <textarea id='summernote1' name="small_description" rows="4" class='form-control'>{{$products->small_description}}
                                                </textarea>
                                            </div>
                                        </div>

                                        {{-- original price required --}}
                                        <div class='col-md-3'>
                                            <div class="form-group">
                                                <label>Original Price</label>
                                                <input type="number" name="original_price" class='form-control' value="{{$products->original_price}}" placeholder='Original Price' required>
                                            </div>
                                        </div>

                                        {{-- Offer price --}}
                                        <div class='col-md-3'>
                                            <div class="form-group">
                                                <label>Offer Price (Optional)</label>
                                                <input type="number" name="offer_price" class='form-control'value="{{$products->offer_price}}" placeholder='Offer Price'>
                                            </div>
                                        </div>

                                        {{-- Quantity required --}}
                                        <div class='col-md-3'>
                                            <div class="form-group">
                                                <label>Quantity</label>
                                                <input type="number" name="quantity" class='form-control' value="{{$products->quantity}}" placeholder='Quantity' required>
                                            </div>
                                        </div>

                                        {{-- Priority required --}}
                                        <div class='col-md-3'>
                                            <div class="form-group">
                                                <label>Priority</label>
                                                <input type="number" name="priority" class='form-control' value="{{$products->priority}}" placeholder='Priority' required>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <!-- image tab required(4) -->
                                <div class="tab-pane fade" id="image" role="tabpanel">

                                    <div class="row mt-4 mb-2 mx-1">
                                        <h5 class="text-dark font-weight-bolder">
                                            <span class="bg-gradient-primary text-white mr-2">
                                                <i class="fa fa-bar-chart" aria-hidden="true"></i>
                                            </span> Please Choose All Images
                                        </h5>
                                    </div>

                                    <div class="row my-4 mx-1">

                                        <!-- prod_image -->
                                        <div class='col-md-6 pro-change'>

                                            <div class="preview">
                                                <img id='img-preview' src="{{ asset('uploads/products/prod/'.$products->prod_image) }}" alt="{{ $products->name }}">
                                            </div>

                                            <!-- Modal Image -->
                                            <div id="myModal-img" class="modal-img">
                                                <span class="close-img">&times;</span>
                                                <img class="modal-content-img" id="img01">
                                                <div id="caption-img"></div>
                                            </div>

                                            <button id="triggerUpload" class="btn-choose-img" type='button' title="Choose Image">
                                                Choose Image (1)
                                            </button>

                                            <input type="file" id="filePicker" name="prod_image" class='prochange-input'>
                                            <div class="fileName"></div>

                                        </div>

                                        <!-- prod_image_1 -->
                                        <div class='col-md-6 pro-change'>

                                            <div class="preview_1">
                                                <img id='img-preview_1' src="{{ asset('uploads/products/prod_1/'.$products->prod_image_1) }}" alt="{{ $products->name }}">
                                            </div>

                                            <!-- Modal Image -->
                                            <div id="myModal-img_1" class="modal-img">
                                                <span class="close-img_1">&times;</span>
                                                <img class="modal-content-img" id="img01_1">
                                                <div id="caption-img_1"></div>
                                            </div>

                                            <button id="triggerUpload_1" class="btn-choose-img" type='button' title="Choose Image">
                                                Choose Image (2)
                                            </button>

                                            <input type="file" id="filePicker_1" name="prod_image_1" class='prochange-input'>
                                            <div class="fileName_1"></div>

                                        </div>

                                        <!-- prod_image_2 -->
                                        <div class='col-md-6 pro-change'>

                                            <div class="preview_2">
                                                <img id='img-preview_2' src="{{ asset('uploads/products/prod_2/'.$products->prod_image_2) }}" alt="{{ $products->name }}">
                                            </div>

                                            <!-- Modal Image -->
                                            <div id="myModal-img_2" class="modal-img">
                                                <span class="close-img_2">&times;</span>
                                                <img class="modal-content-img" id="img01_2">
                                                <div id="caption-img_2"></div>
                                            </div>

                                            <button id="triggerUpload_2" class="btn-choose-img" type='button' title="Choose Image">
                                                Choose Image (3)
                                            </button>

                                            <input type="file" id="filePicker_2" name="prod_image_2" class='prochange-input'>
                                            <div class="fileName_2"></div>

                                        </div>

                                        <!-- prod_image_3 -->
                                        <div class='col-md-6 pro-change'>

                                            <div class="preview_3">
                                                <img id='img-preview_3' src="{{ asset('uploads/products/prod_3/'.$products->prod_image_3) }}" alt="{{ $products->name }}" >
                                            </div>

                                            <!-- Modal Image -->
                                            <div id="myModal-img_3" class="modal-img">
                                                <span class="close-img_3">&times;</span>
                                                <img class="modal-content-img" id="img01_3">
                                                <div id="caption-img_3"></div>
                                            </div>

                                            <button id="triggerUpload_3" class="btn-choose-img" type='button' title="Choose Image">
                                                Choose Image (4)
                                            </button>

                                            <input type="file" id="filePicker_3" name="prod_image_3" class='prochange-input'>
                                            <div class="fileName_3"></div>

                                        </div>

                                    </div>
                                </div>

                                <!-- description tab -->
                                <div class="tab-pane fade" id="descriptions" role="tabpanel">
                                    <div class='row mt-4'>

                                        {{-- Highlights --}}
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>High Lights (Optional)</label>
                                                <input type="text" name='p_highlight_heading' value='{{$products->p_highlight_heading}}' class='form-control' placeholder='High-Light Heading'>
                                                <textarea id='summernote2' name="p_highlights" rows="4" class='form-control'>{{$products->p_highlights}}
                                                </textarea>
                                            </div>
                                        </div>

                                        {{-- Descriptions --}}
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Product Description (Optional)</label>
                                                <input type="text" name='p_description_heading' value='{{$products->p_description_heading}}' class='form-control' placeholder='Product Description'>
                                                <textarea id='summernote3' name="p_description" rows="4" class='form-control'>{{$products->p_description}}
                                                </textarea>
                                            </div>
                                        </div>

                                        {{-- Detail --}}
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Product Details/Specification (Optional)</label>
                                                <input type="text" name='p_details_heading' class='form-control' value='{{$products->p_details_heading}}' placeholder='Product Details/Specification'>
                                                <textarea id='summernote4' name="p_details" rows="4" class='form-control'>{{$products->p_details}}
                                                </textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!-- seo tab required(1) -->
                                <div class="tab-pane fade" id="seo" role="tabpanel">
                                    <div class='row mt-4'>

                                        {{-- Meta Title required--}}
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Meta Title</label>
                                                <input name="meta_title" class='form-control' value="{{$products->meta_title}}">
                                            </div>
                                        </div>

                                        {{-- Meta Description --}}
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Meta Description (Optional)</label>
                                                <textarea name="meta_description" rows="4" class='form-control'>{{$products->meta_description}}
                                                </textarea>
                                            </div>
                                        </div>

                                        {{-- Meta Keywords --}}
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Meta Keywords (Optional)</label>
                                                <textarea name="meta_keyword" rows="4" class='form-control'>{{$products->meta_keyword}}
                                                </textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!-- status tab -->
                                <div class="tab-pane fade" id="status" role="tabpanel">
                                    <div class='row mt-4'>

                                        {{-- New arrival --}}
                                        <div class='col-md-3'>
                                            <div class='form-group'>
                                                <label>New Arrivals</label>
                                                <input type="checkbox" name='new_arrival' class='form-control' {{ $products->new_arrival == '1' ? 'checked' : ' ' }}>
                                            </div>
                                        </div>


                                        {{-- Featured products --}}
                                        <div class='col-md-3'>
                                            <div class='form-group'>
                                                <label>Featured Products</label>
                                                <input type="checkbox" name='featured_products' class='form-control' {{$products->featured_products == '1'? 'checked' : ' '}} >
                                            </div>
                                        </div>

                                        {{-- Popular products --}}
                                        <div class='col-md-3'>
                                            <div class='form-group'>
                                                <label>Popular Products</label>
                                                <input type="checkbox" name='popular_products' class='form-control' {{$products->popular_products == '1'? 'checked' : ' '}}>
                                            </div>
                                        </div>

                                        {{-- Offer products --}}
                                        <div class='col-md-3'>
                                            <div class='form-group'>
                                                <label>Offer Products</label>
                                                <input type="checkbox" name='offers_products' class='form-control' {{$products->offers_products == '1'? 'checked' : ' '}}>
                                            </div>
                                        </div>

                                        {{-- Show / Hide --}}
                                        <div class='col-md-3'>
                                            <div class='form-group'>
                                                <label>Show Hide</label>
                                                <input type="checkbox" name='status' class='form-control' {{$products->status == '1'? 'checked' : ' ' }}>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class='form-group my-4 text-right'>
                                <button type='submit' class='btn btn-primary'>Update Product</button>
                                <button type='reset' class='btn btn-secondary'>Cancel</button>
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
    <script type="text/javascript" src="{{ asset('assets/js/customfile_prod.js') }}"></script>

@endsection

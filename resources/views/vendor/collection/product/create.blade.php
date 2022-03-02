@extends('layouts.vendor')

@section('title')
	Product Add
@endsection


@section('content')

    <div class="container-fluid mt-5">
        <div class="card mb-4 shadow-sm bg-gray-100 border-left-primary">
            <div class="card-body d-sm-flex align-items-center justify-content-between">
                <h6>
                    <a href="{{ url('/vendor/products') }}">Products</a>
                    <span><i class="fas fa-angle-right mx-1"></i></span>
                    <span>Product Add</span>
                </h6>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class='card shadow-sm mb-4'>
                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{session('status')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        {{-- error msgs (11) --}}

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

                        @if (session('status_img'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{session('status_img')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if (session('status_img_1'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{session('status_img_1')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if (session('status_img_2'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{session('status_img_2')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if (session('status_img_3'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{session('status_img_3')}}
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

                        <form action="{{ url('vendor/store-products') }}" method="POST" enctype="multipart/form-data" spellcheck="false">
                            {{ csrf_field() }}

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

                                <!-- product tab required(6) -->
                                <div class="tab-pane fade show active" id="product" role="tabpanel">

                                    <div class='row mt-4'>

                                        {{-- name required --}}
                                        <div class='col-md-6'>
                                            <div class="form-group">
                                                <label>Product Name</label>
                                                <input type="text" name="name" class='form-control' placeholder='Product Name' id="name" required>
                                            </div>
                                            <input type="hidden" name="vendor_id" value="{{ Auth::user()->id }}" />
                                        </div>

                                        {{-- url required --}}
                                        <div class='col-md-6'>
                                            <div class="form-group">
                                                <label>Custom URL</label>
                                                <input type="text" name="url" class='form-control bg-white' placeholder='Custom URL' id="url" readonly required>
                                            </div>
                                        </div>

                                        {{-- choose brand required --}}
                                        <div class='col-md-6'>
                                            <div class="form-group">
                                                <label>Brand</label>
                                                <select name="sub_category_id" class="form-control select2-products" required>
                                                    <option value="">Select Brand</option>
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
                                                <input type="text" name="sale_tag" class='form-control' placeholder='Sale Tag'>
                                            </div>
                                        </div>

                                        {{-- small desc --}}
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Small Description (Optional)</label>
                                                <textarea id="summernote1" name="small_description" placeholder='Small Description about Product' rows="4" class='form-control'></textarea>
                                            </div>
                                        </div>

                                        {{-- original price required --}}
                                        <div class='col-md-3'>
                                            <div class="form-group">
                                                <label>Original Price</label>
                                                <input type="number" name="original_price" class='form-control' placeholder='Original Price' required>
                                            </div>
                                        </div>

                                        {{-- Offer price --}}
                                        <div class='col-md-3'>
                                            <div class="form-group">
                                                <label>Offer Price (Optional)</label>
                                                <input type="number" name="offer_price" class='form-control' placeholder='Offer Price'>
                                            </div>
                                        </div>

                                        {{-- Quantity required --}}
                                        <div class='col-md-3'>
                                            <div class="form-group">
                                                <label>Quantity</label>
                                                <input type="number" name="quantity" class='form-control' placeholder='Quantity' required>
                                            </div>
                                        </div>

                                        {{-- Priority required --}}
                                        <div class='col-md-3'>
                                            <div class="form-group">
                                                <label>Priority</label>
                                                <input type="number" name="priority" class='form-control' placeholder='Priority' required>
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
                                            </span> Please Choose All Images (640 x 640)
                                        </h5>
                                    </div>

                                    <div class="row my-4 mx-1">

                                        <!-- prod_image -->
                                        <div class='col-md-6 pro-change'>
                                            <div class="preview">
                                                <img id='img-preview'>
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
                                                <img id='img-preview_1'>
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
                                                <img id='img-preview_2'>
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
                                                <img id='img-preview_3'>
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
                                                <input type="text" name='p_highlight_heading' class='form-control' placeholder='High-Light Heading'>
                                                <textarea id="summernote2" name="p_highlights" placeholder='High-Light Description' rows="4" class='form-control'></textarea>
                                            </div>
                                        </div>

                                        {{-- Descriptions --}}
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Product Description (Optional)</label>
                                                <input type="text" name='p_description_heading' class='form-control' placeholder='Product Description'>
                                                <textarea id="summernote3" name="p_description" placeholder='Product Description' rows="4" class='form-control'></textarea>
                                            </div>
                                        </div>

                                        {{-- Detail --}}
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Product Details / Specification (Optional)</label>
                                                <input type="text" name='p_details_heading' class='form-control' placeholder='Product Details/Specification'>
                                                <textarea id="summernote4" name="p_details" placeholder='Product Details/Specification' rows="4" class='form-control'></textarea>
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
                                                <label>Meta Title (For better product search)</label>
                                                <input name="meta_title" placeholder='Enter Meta Title' class='form-control'>
                                            </div>
                                        </div>

                                        {{-- Meta Description --}}
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Meta Description (Optional)</label>
                                                <textarea name="meta_description" placeholder='Enter Meta Description' rows="4" class='form-control'></textarea>
                                            </div>
                                        </div>

                                        {{-- Meta Keywords --}}
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Meta Keywords (Optional)</label>
                                                <textarea name="meta_keyword" placeholder='Enter Meta Keyword' rows="4" class='form-control'></textarea>
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
                                                <input type="checkbox" name='new_arrival' class='form-control'>
                                            </div>
                                        </div>

                                        {{-- Featured products --}}
                                        <div class='col-md-3'>
                                            <div class='form-group'>
                                                <label>Featured Products</label>
                                                <input type="checkbox" name='featured_products' class='form-control'>
                                            </div>
                                        </div>

                                        {{-- Popular products --}}
                                        <div class='col-md-3'>
                                            <div class='form-group'>
                                                <label>Popular Products</label>
                                                <input type="checkbox" name='popular_products' class='form-control'>
                                            </div>
                                        </div>

                                        {{-- Offer products --}}
                                        <div class='col-md-3'>
                                            <div class='form-group'>
                                                <label>Offer Products</label>
                                                <input type="checkbox" name='offers_products' class='form-control'>
                                            </div>
                                        </div>

                                        {{-- Show / Hide --}}
                                        <div class='col-md-3'>
                                            <div class='form-group'>
                                                <label>Show Hide</label>
                                                <input type="checkbox" name='status' class='form-control'>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class='form-group my-4 text-right'>
                                <button type='submit' class='btn btn-primary'>Add Product</button>
                                <button type='reset' class='btn btn-secondary'>Cancel</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .select2-container--default .select2-selection--single{
            display: block;
            width: 100%;
            height: calc(1.5em + .75rem + 2px);
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #6e707e;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #d1d3e2;
            border-radius: .35rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #6e707e;
            line-height: 28px;
        }
        .select2-container--default .select2-search--dropdown .select2-search__field{
            outline:none;
            border-radius: 4px;
            border: 1px solid #9c9b9b;
        }
    </style>

@endsection

@section('scripts')

{{-- custom file upload --}}
<script type="text/javascript" src="{{ asset('assets/js/customfile_prod.js') }}"></script>

@endsection

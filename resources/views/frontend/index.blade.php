@extends('layouts.frontend')

@include('layouts.inc.encrypt')

@section('title')
    Home
@endsection

@section('content')

    @include('frontend.slider.slider')

    @if (session('status-no-search'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('status-no-search')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- collections (12) --}}
    <div class="container-fluid">
        <div class="services-outer rounded">

            <div class="page-header mb-5 mt-0">
                <h4 class="page-title text-center font-weight-bolder">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="fa fa-bar-chart" aria-hidden="true"></i>
                </span> Explore Collections </h4>
            </div>

            <nav class="services responsive-wrapper">

                <div class="banner-search ">
                    <input type="search" placeholder="Search Collection..." id="myInput_hcol" class="rounded  banner-search-input" onkeyup="hcolFunction()" />
                </div>

                <ul class="services-list" id="myUL_hcol">
                    @foreach($groups as $i)
                        <li class="services-item rounded waves-effect">
                            <a href="{{ url('collection/'.$i->url)}}" class="services-item-link">{{$i->name}}</a>
                            <p class="services-item-description">{{$i->descrip}}</p>
                        </li>
                    @endforeach
                </ul>

            </nav>

            <div class="services-actions">
                <a href="{{ url("/collections") }}" class="link-btn btn-primary btn text-white px-3 py-3">View all Collections</a>
            </div>

        </div>
    </div>

    <!-- Popular Products (no limit) -->
    <div class="container-fluid">

        <section class="infinite-sec my-3 py-5">

            <div class="page-header mb-4 mt-0">
                <h4 class="page-title text-center font-weight-bolder">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="fa fa-bar-chart" aria-hidden="true"></i>
                </span> Popular Products </h4>
            </div>

            <div class="text-center p-3 mb-5">
                <button class="btn bg-gradient-info text-white rounded toggle-all">
                <i class="fas fa-th" aria-hidden="true"></i> Show List
                </button>
            </div>

            <div id="infinite_carousel" class="d-flex align-items-center slide off-slide">

                <div class="p-3 control"><i class="fa fa-2x fa-chevron-left"></i></div>

                <div class="row w-100 flex-nowrap mx-1">

                    @foreach($popular as $i)
                        @php
                            $truncated = Illuminate\Support\Str::limit($i->name, 50);
                        @endphp
                        <div class="col-6 col-sm-4 col-md-3 col-xl-2 text-center infi-item">
                            <div class='infi-dtl rounded waves-effect'>
                                <a href="{{url('collection/'.$i->subcategory->category->group->url.'/'.$i->subcategory->category->url.'/'.$i->subcategory->url.'/'.$i->url.'/'.Crypt::encrypt($i->id)) }}">
                                <img class="d-block mx-auto img-fluid mb-3 animated fadeIn" src="{{ asset('uploads/products/prod/'.$i->prod_image)}}">
                                <hr>
                                <span class="infi-name animated fadeIn">{{$truncated}}</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="p-3 control"><i class="fa fa-2x fa-chevron-right"></i></div>

            </div>

        </section>

    </div>

    <!-- New Arrivals (6) -->
    <div class="container-fluid">
        <div class="services-outer rounded">

            <div class="page-header mb-5 mt-0">
                <h4 class="page-title text-center font-weight-bolder">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="fa fa-bar-chart" aria-hidden="true"></i>
                </span> New Arrivals </h4>
            </div>

            <nav class="services responsive-wrapper">
                <ul class="services-list">
                    @foreach($newarrivals as $new)
                        @php
                            $truncated = Illuminate\Support\Str::limit($new->small_description, 500);
                        @endphp
                        <li class="services-item rounded waves-effect">
                            <img src="{{ asset('uploads/products/prod/'.$new->prod_image)}}" class="shadow-sm img-fluid rounded mb-3"><hr>
                            <a  href="{{url('collection/'.$new->subcategory->category->group->url.'/'.$new->subcategory->category->url.'/'.$new->subcategory->url.'/'.$new->url.'/'.Crypt::encrypt($new->id))}}" class="services-item-link font-weight-bolder" >{{$new->name}}</a>
                            <p class="services-item-description">{{ strip_tags($truncated) }}...</p>
                        </li>
                    @endforeach
                </ul>
            </nav>

            <div class="services-actions">
                <a href="{{url('/new-arrivals')}}" class="link-btn btn-primary btn text-white px-3 py-3">View all New Arrivals</a>
            </div>

        </div>
    </div>

    <!-- electronic devices -->
	<div class="container-fluid">
        <div class="one-product-slider">
        <div class="row">
            <div class="col-md-6">
            <div id="demo1" class="carousel slide slides" data-ride="carousel">
                <div class="carousel-inner">
                <div class="carousel-item active bg-white">
                    <a href="{{url('collection/electronic-devices')}}">
                    <img src="{{ asset('assets/img/electronics.jpg')}}" alt="Los Angeles" class="waves-effect rounded img-responsive">
                    </a>
                </div>
                </div>
            </div>
            </div>
            <div class="col-md-6">
            <div class="one-product-text">
                <h1>Electronic accessories</h1>
                <p class="text-dark">Choose from a vast collection of electronics accessories and get the best out of your device.
                </p>
                <a href="#s" class="btn text-white bg-gradient-primary waves-effect">Shop Now</a>
            </div>
            </div>
        </div>
        </div>
    </div>

    <!-- Categories (6) -->
    <div class="container-fluid">
        <div class="services-outer rounded">

        <div class="page-header mb-5 mt-0">
            <h4 class="page-title text-center font-weight-bolder">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="fa fa-bar-chart" aria-hidden="true"></i>
            </span> Popular Categories </h4>
        </div>

        <nav class="services responsive-wrapper">
            <ul class="services-list">
                @foreach($categories as $i)
                    <li class="services-item rounded waves-effect">
                        <img src="{{ asset('uploads/categoryimage/'.$i->image)}}" class="shadow-sm img-fluid rounded mb-3"><hr>
                        <a href="{{url('collection/'.$i->group->url.'/'.$i->url)}}" class="services-item-link font-weight-bolder">{{$i->name}}</a>
                        <p class="services-item-description">{{$i->description}}</p>
                    </li>
                @endforeach
            </ul>
        </nav>

        </div>
    </div>

    <!-- sellers (no limit) -->
    <div class="container-fluid">

        <section class="infinite-sec my-3 py-5">

            <div class="page-header mb-4 mt-0">
                <h4 class="page-title text-center font-weight-bolder">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="fa fa-bar-chart" aria-hidden="true"></i>
                </span> Sellers in AllUNeed </h4>
            </div>

            <div class="text-center p-3 mb-5">
                <button class="btn bg-gradient-info text-white rounded toggle-all-1">
                <i class="fas fa-th" aria-hidden="true"></i> Show List
                </button>
            </div>

            <div id="infinite_carousel-1" class="d-flex align-items-center slide off-slide">

                <div class="p-3 control"><i class="fa fa-2x fa-chevron-left"></i></div>

                <div class="row w-100 flex-nowrap mx-1">

                    @for ($i = 0; $i < 6; $i++)
                        <div class="col-6 col-sm-4 col-md-3 col-xl-2 text-center infi-item">
                            <div class='infi-dtl rounded waves-effect'>
                                <a href="#">
                                    <img src="{{ asset('assets/img/user.jpg')}}"  class="d-block mx-auto img-fluid mb-3 animated fadeIn" title="Win mobile" alt="Win mobile">
                                    <hr>
                                    <span class="infi-name animated fadeIn">Win Mobile</span>
                                </a>
                            </div>
                        </div>
                    @endfor

                </div>

                <div class="p-3 control"><i class="fa fa-2x fa-chevron-right"></i></div>

            </div>

            <div class="services-actions">
                <a href="{{ url("/sellers") }}" class="link-btn btn-primary btn text-white px-3 py-3">View all Sellers</a>
            </div>

        </section>

    </div>


@endsection

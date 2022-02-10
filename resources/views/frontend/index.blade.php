@extends('layouts.frontend')

@section('title')
    Home
@endsection

@section('content')

    @include('frontend.slider.slider')

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
                    @for ($i = 0; $i < 6 ; $i++)
                        <li class="services-item rounded waves-effect">
                            <a href="#" class="services-item-link">Electronic Devices</a>
                            <p class="services-item-description">Electronic devices blah blah blah</p>
                        </li>
                    @endfor
                </ul>

            </nav>

            <div class="services-actions">
                <a href="#" class="link-btn btn-primary btn text-white px-3 py-3">View all Collections</a>
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

                    @for ($i = 0; $i < 16; $i++)
                        <div class="col-6 col-sm-4 col-md-3 col-xl-2 text-center infi-item">
                            <div class='infi-dtl rounded waves-effect'>
                                <a href=#">
                                    <img class="d-block mx-auto img-fluid mb-3 animated fadeIn" src="{{ asset('uploads/products/prod/1627930401.jpg')}}">
                                <hr>
                                <span class="infi-name animated fadeIn">Samsung</span>
                                </a>
                            </div>
                        </div>
                    @endfor
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
                @for ($i = 0; $i < 6; $i++)
                    <li class="services-item rounded waves-effect">
                        <img src="{{ asset('uploads/products/prod/1627930401.jpg')}}" class="shadow-sm img-fluid rounded mb-3"><hr>
                        <a  href="#" >Nokia</a>
                        <p class="services-item-description">Nokia is blah blah...</p>
                    </li>
                @endfor
                </ul>
            </nav>

            <div class="services-actions">
                <a href="#" class="link-btn btn-primary btn text-white px-3 py-3">View all New Arrivals</a>
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
                @for ($i = 0; $i < 6; $i++)
                    <li class="services-item rounded waves-effect">
                        <img src="{{ asset('uploads/categoryimage/1626195375.jpg')}}" class="shadow-sm img-fluid rounded mb-3"><hr>
                        <a href="#" class="services-item-link font-weight-bolder">Mobile Phone</a>
                        <p class="services-item-description">Lots of mobile phones blah blah..</p>
                    </li>
                @endfor
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
                <a href="#" class="link-btn btn-primary btn text-white px-3 py-3">View all Sellers</a>
            </div>

        </section>

    </div>


@endsection
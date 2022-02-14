@extends('layouts.frontend')

@section('title')
    New Arrivals
@endsection

@section('content')
    <section class='py-3'>
        <div class="container-fluid">
            <div class="services-outer rounded">

                <div class="page-header mb-5 mt-0">
                    <h4 class="page-title text-center font-weight-bolder">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                        <i class="fa fa-bar-chart" aria-hidden="true"></i>
                    </span> All New Arrival Products </h4>
                </div>

                <nav class="services responsive-wrapper">

                    <div class="banner-search ">
                        <input type="search" placeholder="Search New Arrivals..." id="myInput_hnew" class="rounded  banner-search-input" onkeyup="hnewFunction()" />
                    </div>

                    <ul class="services-list" id="myUL_hnew">
                        @foreach($newarrivals as $new)
                            @php
                                $truncated = Illuminate\Support\Str::limit($new->small_description, 500);
                            @endphp
                            <li class="services-item rounded waves-effect">
                                <img src="{{ asset('uploads/products/prod/'.$new->prod_image)}}" class="shadow-sm img-fluid rounded mb-3"><hr>
                                <a href="{{url('collection/'.$new->subcategory->category->group->url.'/'.$new->subcategory->category->url.'/'.$new->subcategory->url.'/'.$new->url.'/'.Crypt::encrypt($new->id))}}" class="services-item-link font-weight-bolder" >{{$new->name}}</a>
                                <p class="services-item-description">{{ strip_tags($truncated) }}</p>
                            </li>
                        @endforeach
                    </ul>

                </nav>

            </div>
        </div>
    </section>
@endsection

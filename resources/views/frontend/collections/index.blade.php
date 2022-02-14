@extends('layouts.frontend')

@section('title')
    Collections
@endsection

@section('content')
    <section class='py-3'>
        <div class="container-fluid">
            <div class="services-outer rounded">

                <div class="page-header mb-5 mt-0">
                    <h4 class="page-title text-center font-weight-bolder">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                        <i class="fa fa-bar-chart" aria-hidden="true"></i>
                    </span> All Collections </h4>
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

            </div>
        </div>
    </section>
@endsection

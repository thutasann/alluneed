@extends('layouts.frontend')

@section('title')
    {{$group->name}}
@endsection

@section('content')

    <section class='py-3'>
        <div class="container-fluid">

            <div class="bc-icons-2">
                <nav>
                    <ol class="breadcrumb bg-secondary">
                        <li>
                            <a class="link-text font-weight-bolder" href="{{url('collections')}}">Collections</a>
                            <i class="fas fa-angle-right mx-2"></i>
                        </li>

                        <li class="active">{{$group->name}}</li>
                    </ol>
                </nav>
            </div>

            <div class="services-outer rounded">

                <div class="page-header mb-5 mt-0">
                    <h4 class="page-title text-center font-weight-bolder">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                        <i class="fa fa-bar-chart" aria-hidden="true"></i>
                    </span>{{$group->name}} </h4>
                </div>

                <nav class="services responsive-wrapper">

                    <div class="banner-search ">
                        <input type="search" placeholder="Search {{$group->name}}..." id="myInput_hcol" class="rounded  banner-search-input" onkeyup="hcolFunction()" />
                    </div>

                    <ul class="services-list" id="myUL_hcol">
                        @foreach($category as $i)
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
    </section>

@endsection

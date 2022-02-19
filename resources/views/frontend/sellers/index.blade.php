@extends('layouts.frontend')

@include('layouts.inc.encrypt')

@section('title')
    Sellers
@endsection

@section('content')
    <section class='py-3'>
        <div class="container-fluid">
            <div class="services-outer rounded">

                <div class="page-header mb-5 mt-0">
                    <h4 class="page-title text-center font-weight-bolder">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                        <i class="fa fa-bar-chart" aria-hidden="true"></i>
                    </span> All Sellers in AllUNeed </h4>
                </div>

                <nav class="services responsive-wrapper">

                    <div class="banner-search ">
                        <input type="search" placeholder="Search Sellers..." id="myInput_hsel" class="rounded banner-search-input" onkeyup="hselFunction()" />
                    </div>

                    <ul class="services-list" id="myUL_hsel">
                        @foreach($sellers as $v)

                            @php
                                $user_id = $v->id;
                                $vendor = App\Models\Models\Request_vendor::where('user_id', $user_id)->get(); // For displaying vendor name
                                $encrypted = encrypt_decrypt('encrypt', $user_id);
                            @endphp

                            <li class="services-item rounded waves-effect">
                                @foreach ($vendor as $vname)

                                    @php
                                        $slname = preg_replace('/[^a-z0-9]+/i', '_', trim(strtolower($vname->vendor_name)));
                                    @endphp

                                    @if($vname->users->Image == NULL)
                                        <img src="{{ asset('assets/img/user.jpg')}}" class="shadow-sm img-fluid rounded mb-3" title="{{ $vname->vendor_name }}" alt="{{ $vname->vendor_name }}"><hr>
                                    @else
                                        <img src="{{ asset('uploads/profile/'.$vname->users->Image) }}" class="shadow-sm img-fluid rounded mb-3" title="{{ $vname->vendor_name }}" alt="{{ $vname->vendor_name }}"><hr>
                                    @endif

                                    <a href="{{ url('vp/'.$slname.'/'.$encrypted)}}" class="services-item-link font-weight-bolder" >
                                        {{$vname->vendor_name}}
                                    </a>

                                    <p class="services-item-description">{{ strip_tags($vname->description) }}</p>

                                @endforeach

                            </li>

                        @endforeach
                    </ul>

                </nav>

            </div>
        </div>
    </section>
@endsection

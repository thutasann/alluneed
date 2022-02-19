@extends('layouts.frontend')

@include('layouts.inc.encrypt')

@section('title')
    @foreach($vendor as $v)
        {{ $v->vendor_name }}
    @endforeach
@endsection

@section('content')

<body id="profile-body">
    <div class="main-content-pro">

        <div class="container-fluid pro-sec">
            <div class="row">

                <!-- info side -->
                <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                    <div class="card card-profile shadow">

                        <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image mb-3">
                            <a href="#">
                                @if($user->Image == NULL)
                                <img src="{{ asset('assets/img/user.jpg')}}" class="rounded-circle z-depth-0" width="100px">
                                @else
                                <img src="{{ asset('uploads/profile/'.$user->Image)}}">
                                @endif
                            </a>
                            </div>
                        </div>
                        </div>

                        <div class="card-header text-center border-0 pt-8 pt-md-4">
                        <div class="d-flex justify-content-between">
                            <a href="#" class="btn btn-sm btn-info mr-4">Connect</a>
                            <a href="#" class="btn btn-sm btn-success float-right">Message</a>
                        </div>
                        </div>

                        <div class="card-body pt-0">

                        <div class="text-center mt-5">

                            <h3 class="mb-2">
                            <span class="pro-name" id="pro-name">
                                @foreach ($vendor as $iv )
                                <span>{{ $iv->vendor_name }}</span>
                                @endforeach
                            </span>
                            </h3>

                            <p class="mt-3 mb-4 text-muted">
                            @foreach ($vendor as $iv )
                                <span>{{ $iv->description }}</span>
                            @endforeach
                            </p>

                            <div class="h5 my-3">
                            <i class="fas fa-user-tie blue-text"></i>&nbsp;
                            <span>{{ $user->name }}</span>
                            </div>

                            <div class="h5 my-3">
                            <i class="fas fa-flag blue-text"></i> <span class='country' id="country">{{ $user->country}}</span>
                            </div>

                            <div class="h5 mt-2">
                            <i class="fas fa-envelope blue-text"></i> <a href="mailto:{{ Auth::user()->email}}">{{ $user->email}}</a>
                            </div>

                            <div class="mt-4 text-muted">
                            <i class="fas fa-calendar blue-text"></i> Member of AllUNeed since {{ date('F j, Y',strtotime($user->created_at)) }}
                            </div>

                            <hr class="my-4">

                            <p><i class="fas fa-map-marked blue-text"></i> <span class='address1' id="address1">{{ $user->address1}}</span></p>

                            <a href="#">Show more</a>

                        </div>

                        </div>

                    </div>
                </div>

                <!-- Products side -->
                <div class="col-xl-8 order-xl-1">
                    <main id="prodisplay">

                        <div class="page-header mb-2 mt-0">
                            <h4 class="page-title text-left font-weight-bolder">
                            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                                <i class="fa fa-bar-chart" aria-hidden="true"></i>
                            </span>Vendor Profile</h4>
                        </div>

                        <form method="GET" action="{{ URL::current() }}">
                            <div class="banner-search ">
                            {{ csrf_field() }}
                            @foreach ($vendor as $v)
                                @if(isset($_GET["q"]))
                                <input type="search" name="q" value="{{ $_GET["q"] }}" placeholder="Search products in {{$v->vendor_name}}..."  class="rounded mt-0 banner-search-input" />
                                @else
                                <input type="search" name="q" placeholder="Search products in {{$v->vendor_name}}..."  class="rounded mt-0 banner-search-input" />
                                @endif
                            @endforeach
                            </div>
                        </form>

                        @if(isset($_GET["q"]))
                            <div class="bc-icons-2 mb-4 mt-0">
                            <nav>
                                <ol class="breadcrumb bg-secondary">

                                <li>
                                    <a href="{{ URL::current() }}" style="font-size: 1.05rem; font-weight: 600; color: #007bff;">
                                    @foreach($vendor as $v)
                                        {{ $v->vendor_name }}
                                    @endforeach
                                    </a>
                                    <i class="fas fa-angle-right mr-2 ml-1"></i>
                                </li>

                                <li class="active font-weight-bolder" style="padding-top: 1px;">
                                    [ Showing Result From : {{$_GET["q"]}} ]
                                </li>

                                </ol>
                            </nav>
                            </div>
                        @endif

                        @foreach($products as $prod_item)

                            @php
                            $cutdesc = substr($prod_item->small_description,0,150);
                            $encrypted = encrypt_decrypt('encrypt', $prod_item->vendor_id);
                            $truncated = Illuminate\Support\Str::limit($prod_item->small_description, 450);
                            @endphp

                            <article class="card">

                                <figure>
                                <a href="{{url('collection/'.$prod_item->subcategory->category->group->url.'/'.$prod_item->subcategory->category->url.'/'.$prod_item->subcategory->url.'/'.$prod_item->url.'/'.Crypt::encrypt($prod_item->id))}}">
                                    <span class="ribbon badge badge-info text-white p-3">{{$prod_item->sale_tag}}</span>
                                    <img src="{{ asset('uploads/products/prod/'.$prod_item->prod_image)}}">
                                </a>
                                </figure>

                                <div class="flex-content">

                                    <p class="user mt-0 pb-3">

                                        @if($prod_item->user->Image)
                                        @foreach ($vendor as $vname)
                                            @php
                                            $slname   = preg_replace('/[^a-z0-9]+/i', '_', trim(strtolower($vname->vendor_name)));
                                            @endphp
                                            <a href="{{ url('vp/'.$slname.'/'.$encrypted)}}">
                                            <img src="{{ asset('uploads/profile/'.$prod_item->user->Image) }}" class="avatar" alt="{{ $vname->vendor_name }}" title="{{ $vname->vendor_name }}">
                                            </a>
                                        @endforeach
                                        @else
                                        @foreach ($vendor as $vname)
                                            @php
                                            $slname   = preg_replace('/[^a-z0-9]+/i', '_', trim(strtolower($vname->vendor_name)));
                                            @endphp
                                            <a href="{{ url('vendor/'.$slname.'/'.$encrypted)}}">
                                            <img src="{{ asset('assets/img/user.jpg')}}"  class="avatar" alt="{{ $vname->vendor_name }}" title="{{ $vname->vendor_name }}">
                                            </a>
                                        @endforeach
                                        @endif

                                        <br/><br/><br/><br/><br/><br/>

                                        <strong class="vname">
                                        @foreach ($vendor as $vname)
                                            @php
                                            $slname   = preg_replace('/[^a-z0-9]+/i', '_', trim(strtolower($vname->vendor_name)));
                                            @endphp
                                            <a href="{{ url('vp/'.$slname.'/'.$encrypted)}}" class="text-primary" style="font-size: 1.3rem;">
                                            {{ $vname->vendor_name }}
                                            </a>
                                        @endforeach
                                        </strong>

                                        <span class="timeago">
                                            {{$prod_item->created_at->diffForHumans()}} &middot; {{$prod_item->subcategory->name}}
                                        </span>

                                    </p>

                                    <ul>
                                    <li id="prod_name"><strong>Name :</strong>{{$prod_item->name}}</li>
                                    <li>
                                        <strong>Price :</strong><ins>${{number_format($prod_item->offer_price,2)}}</ins>
                                        <small class="ml-2"><del>${{number_format($prod_item->original_price,2)}}</del></small>
                                    </li>
                                    <li><strong>Brand :</strong>{{$prod_item->subcategory->name}}</li>
                                    <li>{{ strip_tags($truncated) }}...</li>
                                    </ul>

                                    <footer>
                                        <p>
                                            <a class="bg-gradient-info btn text-white rounded" href="{{url('collection/'.$prod_item->subcategory->category->group->url.'/'.$prod_item->subcategory->category->url.'/'.$prod_item->subcategory->url.'/'.$prod_item->url.'/'.Crypt::encrypt($prod_item->id))}}">
                                            View Detail</a>
                                        </p>
                                    </footer>

                                </div>

                            </article>

                        @endforeach

                    </main>
                </div>

            </div>
        </div>

    </div>
</body>

@endsection

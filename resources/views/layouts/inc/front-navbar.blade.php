@php

    $ip =  request()->getHttpHost();
    $url = "http://www.geoplugin.net/json.gp?ip=".$ip;
    $userInfo = file_get_contents($url);
    $result = json_decode($userInfo,true);

    $ipaddress = $result['geoplugin_request'];
    $country = $result['geoplugin_countryName'];
    $city = $result['geoplugin_city'];
    $state = $result['geoplugin_regionName'];
    $countrycode = $result['geoplugin_countryCode'];
    $latitude = $result['geoplugin_latitude'];
    $longitude = $result['geoplugin_longitude'];
    $timezone = $result['geoplugin_timezone'];

@endphp


<nav class="navbar first-nav shadow-none">
    <div class="container-fluid mx-3">

        <a class="navbar-brand" href="{{ url('/')}}">
            <img src="{{ asset('assets/img/logo.png')}}">
        </a>

        <span hover-tooltip="Your Address according to IP Address" tooltip-position="bottom" class='d-none d-md-block ml-3 deli-add'>
            Delliver to <i class="fas fa-map-marker-alt"></i><br>
            <span class="font-weight-bold">{{ $country }}</span>
        </span>

        <ul class="navbar-nav ml-auto nav-flex-icons text-dark">
            @guest

                <li class="nav-item mr-3">
                    <a class="nav-link waves-effect text-dark" href="#">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="clearfix">
                        <span class="basket-item-count">
                            <span class="badge badge-pill red"> 0 </span>
                        </span>
                        </span>
                    </a>
                </li>

                <li class="nav-item font-weight-bolder">
                    <a class="nav-link text-info waves-effect" href="{{ route('login') }}">Login</a>
                </li>
                <span class="text-info ml-2 mr-2 mt-2">|</span>
                <li class="nav-item font-weight-bolder">
                    <a class="nav-link text-info waves-effect" href="{{ route('register') }}">Register</a>
                </li>

            @else

                <li class="nav-item dropdown mr-3 mt-2">
                    <a class="nav-link text-dark waves-effect dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                        <span class="clearfix">
                        <span class="">
                            <span class="badge badge-pill red"> 0 </span>
                        </span>
                        </span>
                    </a>
                    <div class="dropdown-list dropdown-menu dropdown-menu-right">
                        <h3 class="dropdown-header text-white">Notifications</h3>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="mr-3">
                            <div class="icon-circle bg-primary">
                            <i class="fas fa-file-alt text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">December 12, 2019</div>
                            <span class="font-weight-bold">A new monthly report is ready to download!</span>
                        </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="mr-3">
                            <div class="icon-circle bg-success">
                            <i class="fas fa-donate text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">December 7, 2019</div>
                            $290.29 has been deposited into your account!
                        </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="mr-3">
                            <div class="icon-circle bg-warning">
                            <i class="fas fa-exclamation-triangle text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">December 2, 2019</div>
                            Spending Alert: We've noticed unusually high spending for your account.
                        </div>
                        </a>
                        <a class="dropdown-item dropdown-footer text-center small text-gray-500" href="#">Show All Notifications</a>
                    </div>
                </li>

                <li class="nav-item mt-2">
                    <a class="nav-link waves-effect text-dark" href="{{ url('/cart')}}">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="clearfix">
                        <span class="basket-item-count">
                            <span class="badge badge-pill red"> 0 </span>
                        </span>
                        </span>
                    </a>
                </li>

                <div class="topbar-divider d-sm-block"></div>

                <li class="nav-item dropdown mr-2">
                    <a title="{{ Auth::user()->name }}" class="nav-link waves-effect dropdown-toggle mr-1" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        @if(Auth::user()->Image == NULL)
                            <img src="{{ asset('assets/img/user.jpg')}}"  class="rounded-circle z-depth-0" width="40px">
                        @else
                            <img src="{{ asset('uploads/profile/'.Auth::user()->Image) }}" class="rounded-circle z-depth-0" width="40px">
                        @endif
                    </a>

                    @php
                        $slname   = preg_replace('/[^a-z0-9]+/i', '.', trim(strtolower(Auth::user()->name)));
                    @endphp

                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="{{ url('me/'.$slname) }}" class="dropdown-item">
                        <i class="fas fa-user mr-2"></i>My Profile
                    </a>

                    <a href="{{ url('wishlist') }}" class="dropdown-item">
                        <i class="fas fa-heart mr-2"></i>Wishlist
                    </a>

                    <a href="{{ url('orders/'.$slname) }}" class="dropdown-item">
                        <i class="fas fa-truck mr-2"></i>Your Orders
                    </a>

                    <a href="{{ url('activityall/'.$slname ) }}" class="dropdown-item">
                        <i class="fas fa-list mr-2"></i>Activity Log
                    </a>

                    <a href="#" class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </a>

                </div>
                </li>

            @endguest
        </ul>

    </div>
</nav>

<nav class="navbar sticky-top navbar-expand-lg navbar-light white sec-nav">

    <div class="container-fluid">

        <form class="form-block" method="POST" action="{{ url('/search') }}" id="search-form">
            {{ csrf_field() }}
            <div class="md-form input-group">
                <input class="form-control" name="search_product" id="search_text" type="search" placeholder="Search Products...">
                <button type="submit" name="searchbtn" class="input-group-text d-none"><i class="fas fa-search"></i></button>
            </div>
        </form>

        <button class="navbar-toggler mr-4 mt-3" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav mt-2 ml-auto nav-flex-icons">

                <li class="nav-item">
                    <a class="nav-link waves-effect" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item dropdown megamenu ">
                    <a class="nav-link waves-effect dropdown-toggle" id="megamneu" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Shops <i class="fas fa-caret-down"></i></a>

                    <div aria-labelledby="megamneu" class="dropdown-menu border-0 p-0 mt-0">
                        <div class="row">

                            {{-- Collections --}}
                            <div class="col-md-6 col-xl-4 sub-menu mb-xl-0 mb-4">
                                <h6 class="sub-title text-uppercase">Collections</h6>

                                <div class="form-inline d-flex pl-2 md-form">
                                    <i class="fas fa-search"></i>
                                    <input class="form-control-sm ml-2" type="search" placeholder="Search Colections..." id="myInput_col" onkeyup="colFunction()">
                                </div>

                                <ul class="list-unstyled" id="myUL_col">
                                    {{-- @php
                                    $group_nav = App\Models\Groups::where('status', '0')->where('status', '!=' , '1')->where('status','!=','2')->get();
                                    @endphp --}}

                                    @for ($i = 0; $i < 6; $i++)
                                        <li>
                                            <a class="menu-item pl-0 d-block" href="#">
                                            <i class="fas fa-caret-right pl-1 pr-3"></i>Electronic Devices
                                            </a>
                                        </li>
                                    @endfor

                                    {{-- @foreach ($group_nav as $group_nav_item)
                                    <li>
                                        <a class="menu-item pl-0 d-block" href="{{url('collection/'.$group_nav_item->url)}}">
                                        <i class="fas fa-caret-right pl-1 pr-3"></i>{{$group_nav_item->name}}
                                        </a>
                                    </li>
                                    @endforeach --}}
                                </ul>

                            </div>

                            {{-- Categories --}}
                            <div class="col-md-6 col-xl-4 sub-menu mb-xl-0 mb-4">
                                <h6 class="sub-title text-uppercase">Categories</h6>

                                <div class="form-inline d-flex pl-2 md-form">
                                    <i class="fas fa-search"></i>
                                    <input class="form-control-sm ml-2" type="search" placeholder="Search Categories..." id="myInput_cate" onkeyup="cateFunction()">
                                </div>

                                <ul class="list-unstyled" id="myUL_cate">
                                    {{-- @php
                                    $cate_nav = App\Models\Category::where('status', '0')->where('status','!=', '1')->where('status','!=','3')->get();
                                    @endphp --}}

                                    @for ($i = 0; $i < 6; $i++)
                                        <li>
                                            <a class="menu-item pl-0 d-block" href="#">
                                                <i class="fas fa-caret-right pl-1 pr-3"></i>Mobile <span>(Electronic)</span>
                                            </a>
                                        </li>
                                    @endfor

                                    {{-- @foreach ($cate_nav as $cate_nav_item)
                                    <li>
                                        <a class="menu-item pl-0 d-block" href="{{url('collection/'.$cate_nav_item->group->url.'/'.$cate_nav_item->url)}}">
                                        <i class="fas fa-caret-right pl-1 pr-3"></i>{{$cate_nav_item->name}} <span>({{$cate_nav_item->group->name}})</span>
                                        </a>
                                    </li>
                                    @endforeach --}}
                                </ul>
                            </div>

                            {{-- Brands --}}
                            <div class="col-md-6 col-xl-4 sub-menu mb-xl-0 mb-4">
                                <h6 class="sub-title text-uppercase">Brands</h6>

                                <div class="form-inline d-flex pl-2 md-form">
                                    <i class="fas fa-search"></i>
                                    <input class="form-control-sm ml-2" type="search" placeholder="Search Brands..." id="myInput_brd" onkeyup="brdFunction()">
                                </div>

                                <ul class="list-unstyled" id="myUL_brd">
                                    {{-- @php
                                    $brand_nav = App\Models\Subcategory::where('status', '0')->where('status', '!=' , '1')->where('status', '!=', '3')->get();
                                    @endphp --}}

                                    @for ($i = 0; $i < 6; $i++)
                                        <li>
                                            <a class="menu-item pl-0 d-block" href="#)}}">
                                            <i class="fas fa-caret-right pl-1 pr-3"></i>Samsung <span>(Mobile)</span>
                                            </a>
                                        </li>
                                    @endfor

                                    {{-- @foreach ($brand_nav as $brand_nav_item)
                                    <li>
                                        <a class="menu-item pl-0 d-block" href="{{url('collection/'.$brand_nav_item->category->group->url.'/'.$brand_nav_item->category->url.'/'.$brand_nav_item->url)}}">
                                        <i class="fas fa-caret-right pl-1 pr-3"></i>{{$brand_nav_item->name}} <span>({{$brand_nav_item->category->name}})</span>
                                        </a>
                                    </li>
                                    @endforeach --}}
                                </ul>
                            </div>

                        </div>
                    </div>
                </li>

                <li class="nav-item dropdown megamenu">
                    <a class="nav-link waves-effect dropdown-toggle" id="megamneu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">News <i class="fas fa-caret-down"></i></a>

                    <div aria-labelledby="megamneu1" class="dropdown-menu border-0 p-0 mt-0">
                    <div class="row">
                        <div class="col-md-6 col-xl-3 sub-menu mb-4">
                        <h6 class="sub-title text-uppercase font-weight-bold white-text">Featured</h6>
                        <ul class="list-unstyled">
                            <li>
                            <a class="menu-item pl-0" href="#!">
                                <i class="fas fa-caret-right pl-1 pr-3"></i>Lorem ipsum dolor sit amet
                            </a>
                            </li>
                            <li>
                            <a class="menu-item pl-0" href="#!">
                                <i class="fas fa-caret-right pl-1 pr-3"></i>Consectetur adipiscing elit
                            </a>
                            </li>
                            <li>
                            <a class="menu-item pl-0" href="#!">
                                <i class="fas fa-caret-right pl-1 pr-3"></i>Sed do eiusmod tempor incididunt
                            </a>
                            </li>
                            <li>
                            <a class="menu-item pl-0" href="#!">
                                <i class="fas fa-caret-right pl-1 pr-3"></i>Ut labore et dolore magna
                            </a>
                            </li>
                            <li>
                            <a class="menu-item pl-0" href="#!">
                                <i class="fas fa-caret-right pl-1 pr-3"></i>Ut enim ad minim veniam
                            </a>
                            </li>
                        </ul>
                        </div>
                        <div class="col-md-6 col-xl-3 sub-menu mb-4 mb-xl-0">
                        <h6 class="sub-title text-uppercase font-weight-bold white-text">Related</h6>
                        <!--Featured image-->
                        <a href="#!" class="view overlay z-depth-1 p-0 mb-2">
                            <img src="https://mdbootstrap.com/img/Photos/Horizontal/Work/6-col/img%20(43).jpg" class="img-fluid"
                            alt="First sample image">
                            <div class="mask rgba-white-slight"></div>
                        </a>
                        <a class="news-title font-weight-bold pl-0" href="#!">Lorem ipsum dolor sit</a>
                        <p class="font-small text-uppercase white-text">
                            <i class="fas fa-clock-o pr-2" aria-hidden="true"></i>July 17, 2017 / <i class="far fa-comments px-1"
                            aria-hidden="true"></i> 20
                        </p>
                        </div>
                        <div class="col-md-6 col-xl-3 sub-menu mb-md-0 mb-xl-0 mb-4">
                        <h6 class="sub-title text-uppercase font-weight-bold white-text">Design</h6>
                        <!--Featured image-->
                        <a href="#!" class="view overlay z-depth-1 p-0 mb-2">
                            <img src="https://mdbootstrap.com/img/Photos/Horizontal/Work/6-col/img%20(44).jpg" class="img-fluid"
                            alt="First sample image">
                            <div class="mask rgba-white-slight"></div>
                        </a>
                        <a class="news-title font-weight-bold pl-0" href="#!">Ut labore et dolore magna</a>
                        <p class="font-small text-uppercase white-text">
                            <i class="fas fa-clock-o pr-2" aria-hidden="true"></i>July 16, 2017 / <i class="far fa-comments px-1"
                            aria-hidden="true"></i> 25
                        </p>
                        </div>
                        <div class="col-md-6 col-xl-3 sub-menu mb-0">
                        <h6 class="sub-title text-uppercase font-weight-bold white-text">Programming</h6>
                        <ul class="list-unstyled">
                            <li>
                            <a class="menu-item pl-0" href="#!">
                                <i class="fas fa-caret-right pl-1 pr-3"></i>Totam rem aperiam eaque
                            </a>
                            </li>
                            <li>
                            <a class="menu-item pl-0" href="#!">
                                <i class="fas fa-caret-right pl-1 pr-3"></i>Beatae vitae dicta sun
                            </a>
                            </li>
                            <li>
                            <a class="menu-item pl-0" href="#!">
                                <i class="fas fa-caret-right pl-1 pr-3"></i>Quae ab illo inventore veritatis et quasi
                                architecto
                            </a>
                            </li>
                            <li>
                            <a class="menu-item pl-0" href="#!">
                                <i class="fas fa-caret-right pl-1 pr-3"></i>Nemo enim ipsam voluptatem
                            </a>
                            </li>
                            <li>
                            <a class="menu-item pl-0" href="#!">
                                <i class="fas fa-caret-right pl-1 pr-3"></i>Neque porro quisquam est
                            </a>
                            </li>
                        </ul>
                        </div>
                        <div class="col-md-6 col-xl-3 sub-menu mb-4">
                        <h6 class="sub-title text-uppercase font-weight-bold white-text">Featured</h6>
                        <ul class="list-unstyled">
                            <li>
                            <a class="menu-item pl-0" href="#!">
                                <i class="fas fa-caret-right pl-1 pr-3"></i>Lorem ipsum dolor sit amet
                            </a>
                            </li>
                            <li>
                            <a class="menu-item pl-0" href="#!">
                                <i class="fas fa-caret-right pl-1 pr-3"></i>Consectetur adipiscing elit
                            </a>
                            </li>
                            <li>
                            <a class="menu-item pl-0" href="#!">
                                <i class="fas fa-caret-right pl-1 pr-3"></i>Sed do eiusmod tempor incididunt
                            </a>
                            </li>
                            <li>
                            <a class="menu-item pl-0" href="#!">
                                <i class="fas fa-caret-right pl-1 pr-3"></i>Ut labore et dolore magna
                            </a>
                            </li>
                            <li>
                            <a class="menu-item pl-0" href="#!">
                                <i class="fas fa-caret-right pl-1 pr-3"></i>Ut enim ad minim veniam
                            </a>
                            </li>
                        </ul>
                        </div>
                        <div class="col-md-6 col-xl-3 sub-menu mb-4 mb-xl-0">
                        <h6 class="sub-title text-uppercase font-weight-bold white-text">Related</h6>
                        <!--Featured image-->
                        <a href="#!" class="view overlay z-depth-1 p-0 mb-2">
                            <img src="https://mdbootstrap.com/img/Photos/Horizontal/Work/6-col/img%20(43).jpg" class="img-fluid"
                            alt="First sample image">
                            <div class="mask rgba-white-slight"></div>
                        </a>
                        <a class="news-title font-weight-bold pl-0" href="#!">Lorem ipsum dolor sit</a>
                        <p class="font-small text-uppercase white-text">
                            <i class="fas fa-clock-o pr-2" aria-hidden="true"></i>July 17, 2017 / <i class="far fa-comments px-1"
                            aria-hidden="true"></i> 20
                        </p>
                        </div>
                        <div class="col-md-6 col-xl-3 sub-menu mb-md-0 mb-xl-0 mb-4">
                        <h6 class="sub-title text-uppercase font-weight-bold white-text">Design</h6>
                        <!--Featured image-->
                        <a href="#!" class="view overlay z-depth-1 p-0 mb-2">
                            <img src="https://mdbootstrap.com/img/Photos/Horizontal/Work/6-col/img%20(44).jpg" class="img-fluid"
                            alt="First sample image">
                            <div class="mask rgba-white-slight"></div>
                        </a>
                        <a class="news-title font-weight-bold pl-0" href="#!">Ut labore et dolore magna</a>
                        <p class="font-small text-uppercase white-text">
                            <i class="fas fa-clock-o pr-2" aria-hidden="true"></i>July 16, 2017 / <i class="far fa-comments px-1"
                            aria-hidden="true"></i> 25
                        </p>
                        </div>
                        <div class="col-md-6 col-xl-3 sub-menu mb-0">
                        <h6 class="sub-title text-uppercase font-weight-bold white-text">Programming</h6>
                        <ul class="list-unstyled">
                            <li>
                            <a class="menu-item pl-0" href="#!">
                                <i class="fas fa-caret-right pl-1 pr-3"></i>Totam rem aperiam eaque
                            </a>
                            </li>
                            <li>
                            <a class="menu-item pl-0" href="#!">
                                <i class="fas fa-caret-right pl-1 pr-3"></i>Beatae vitae dicta sun
                            </a>
                            </li>
                            <li>
                            <a class="menu-item pl-0" href="#!">
                                <i class="fas fa-caret-right pl-1 pr-3"></i>Quae ab illo inventore veritatis et quasi
                                architecto
                            </a>
                            </li>
                            <li>
                            <a class="menu-item pl-0" href="#!">
                                <i class="fas fa-caret-right pl-1 pr-3"></i>Nemo enim ipsam voluptatem
                            </a>
                            </li>
                            <li>
                            <a class="menu-item pl-0" href="#!">
                                <i class="fas fa-caret-right pl-1 pr-3"></i>Neque porro quisquam est
                            </a>
                            </li>
                        </ul>
                        </div>
                    </div>
                    </div>

                </li>

            </ul>

        </div>

    </div>

</nav>

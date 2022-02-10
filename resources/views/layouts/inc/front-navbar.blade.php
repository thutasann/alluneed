{{-- @php 
  
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
  
@endphp --}}


<nav class="navbar first-nav shadow-none">
  <div class="container-fluid mx-3">

    <a class="navbar-brand" href="{{ url('/')}}">
        <img src="{{ asset('assets/img/logo.png')}}">
    </a> 

    {{-- <span hover-tooltip="Your Address according to IP Address" tooltip-position="bottom" class='d-none d-md-block ml-3 deli-add'>
        Delliver to <i class="fas fa-map-marker-alt"></i><br>
        <span class="font-weight-bold">{{ $city }}, {{ $country }}</span>
    </span> --}}
    
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
            <a class="nav-link text-info waves-effect" href="">Login</a>
            </li>
            <span class="text-info ml-2 mr-2 mt-2">|</span>
            <li class="nav-item font-weight-bolder">
            <a class="nav-link text-info waves-effect" href="">Register</a>
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
                <a title="" class="nav-link waves-effect dropdown-toggle mr-1" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ asset('assets/img/user.jpg')}}"  class="rounded-circle z-depth-0" width="40px">
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a href="" class="dropdown-item">
                        <i class="fas fa-user mr-2"></i>My Profile
                    </a>

                    <a href="{{ url('wishlist') }}" class="dropdown-item">
                        <i class="fas fa-heart mr-2"></i>Wishlist
                    </a>

                    <a href="" class="dropdown-item">
                        <i class="fas fa-truck mr-2"></i>Your Orders
                    </a>
                    
                    <a href="" class="dropdown-item">
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

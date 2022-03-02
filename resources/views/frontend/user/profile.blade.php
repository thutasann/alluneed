@extends('layouts.frontend')

@section('title')
    {{ Auth::user()->name}}
@endsection

@section('content')

<body id="profile-body">

    <div class="form-group fixed-top" id="process_profile" style="display:none;">
        <div class="progress md-progress" style="border-radius:0; height:1.9vh;">
            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>

    <div class="main-content-pro mb-3">
        <div class="container-fluid pro-sec">
            <div class="row">

                {{-- info side --}}
                <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                    <div class="card card-profile shadow">

                        <div class="row justify-content-center">
                            <div class="col-lg-3 order-lg-2">
                                <div class="card-profile-image mb-3">
                                <a href="#">
                                    @if(Auth::user()->Image == NULL)
                                    <img src="{{ asset('assets/img/user.jpg')}}" class="rounded-circle z-depth-0" width="100px">
                                    @else
                                    <img src="{{ asset('uploads/profile/'.Auth::user()->Image)}}" name="Image">
                                    @endif
                                </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body pt-3" style="margin-top: 4rem;">

                        <div class="row mt-3">
                            <div class="col">
                            <div class="card-profile-stats d-flex justify-content-center mt-md-0">
                                <div>
                                <span class="heading">22</span>
                                <span class="description">Products</span>
                                </div>
                                <div>
                                <span class="heading">10</span>
                                <span class="description">Wishlist</span>
                                </div>
                                <div>
                                <span class="heading">89</span>
                                <span class="description">Orders</span>
                                </div>
                            </div>
                            </div>
                        </div>

                        <span id="success_message_profile"></span>

                        <div class="text-center mt-0">

                            <h3 class="mb-2">
                            <span class="pro-name" id="pro-name">{{ Auth::user()->name}}</span>
                            @if(Auth::user()->role_as == 'vendor')
                                <span class='roles'>(Vendor)</span>
                            @else
                            @endif
                            </h3>

                            @if(Auth::user()->role_as == 'vendor')
                            <p class="mt-3 mb-4 text-muted" id="v_desc">
                                @foreach ($vendor_name as $v )
                                <span class="v_desc">{{ $v->description }}</span>
                                @endforeach
                            </p>
                            @else
                            @endif

                            @if(Auth::user()->role_as == 'vendor')
                            <div class="h5 my-3" id="v_name">
                                <i class="fas fa-user-tie blue-text"></i>&nbsp;
                                @foreach ($vendor_name as $iv )
                                <span class="v_name">{{ $iv->vendor_name }}</span>
                                @endforeach
                            </div>
                            @else
                            @endif

                            <div class="h5 my-3">
                            <i class="fas fa-flag blue-text"></i> <span class='country' id="country">{{ Auth::user()->country}}</span>
                            </div>

                            <div class="h5 mt-2">
                            <i class="fas fa-envelope blue-text"></i> <a href="mailto:{{ Auth::user()->email}}">{{ Auth::user()->email}}</a>
                            </div>

                            <div class="mt-4 text-muted">
                            <i class="fas fa-calendar blue-text"></i> Member of AllUNeed since {{ date('F j, Y',strtotime(Auth::user()->created_at)) }}
                            </div>

                            <hr class="my-4">

                            <p><i class="fas fa-map-marked blue-text"></i> <span class='address1' id="address1">{{ Auth::user()->address1}}</span></p>

                            <a href="#">Show more</a>

                        </div>

                        </div>

                    </div>
                </div>

                {{-- update side --}}
                <div class="col-xl-8 order-xl-1" id="pro-edit">
                    <div class="card bg-secondary shadow">

                        <div class="card-header bg-white border-0">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4 class="mb-0">Account Info</h4>
                                </div>
                                <div>
                                    <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#updatepsw">Update Password</a>
                                    <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#updateimg">Update Image</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body bg-secondary">


                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                                    {{session('status')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if (session('statuspic'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{session('statuspic')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            @if (session('statuspro'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{session('statuspro')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            @if (session('status_req'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{session('status_req')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            @if (session('update_vendor'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{session('update_vendor')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif


                            @if(Auth::user()->role_as == 'vendor')
                            <div class="alert alert-info go-vendor">
                                Your Account is a Vendor account in our website 'AllUNeed'. You can now upload products in <br> 'Vendor Dashboard ' and sell these products in our website.
                                <a href="{{ url('/vendor-dashboard') }}" target='_blank' class='btn btn-info py-2 waves-effect'>
                                Go to Vendor Dashboard <i class="fas fa-arrow-alt-circle-right"></i>
                                </a>
                            </div>
                            @else
                            @endif

                            @if($req_pending)
                            <div class="alert alert-info">
                                Your Vendor Request is Pending now, Admin will approve very soon.
                            </div>
                            @else
                            @endif

                            <form class='profile-update' action="{{ url('my-profile-update/'.Auth::user()->id) }}" method="POST" id="pro_update_form">
                                {{ csrf_field() }}
                                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />

                                <ul class="nav  nav-tabs nav-justified md-tabs" id="myTabJust" role="tablist">
                                    <li class="nav-item ">
                                        <a class="nav-link active" id="user-tab-just" data-toggle="tab" href="#user-just" aria-selected="true">
                                        User Info
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-tab-just" data-toggle="tab" href="#contact-just" aria-selected="false">
                                        Contact Info
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content pro-tab pt-5" id="myTabContentJust">

                                <div class="tab-pane animated slideInDown fade active show" id="user-just" role="tabpanel" aria-labelledby="user-tab-just">
                                    <div class="pl-lg-4 ">
                                        <div class="row">

                                        <div class="col-lg-6">
                                            <div class="form-group focused">
                                            <label class="form-control-label">Full Name</label>
                                            <input type="text" id="fname" name="fname" class="form-control form-control-alternative" placeholder="Full Name"  value="{{ Auth::user()->name}}" spellcheck="false" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label">Sur Name</label>
                                                <input type="text" id="lname" name="lname" class="form-control form-control-alternative" placeholder="Sur Name" value="{{ Auth::user()->lname}}" spellcheck="false">
                                            </div>
                                        </div>

                                        <div class="{{ $req_pending ? 'col-md-12' : 'col-md-6' }}">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-email">Email address</label>
                                                <input type="email"  class="form-control form-control-alternative bg-white" value="{{ Auth::user()->email}}" readonly spellcheck="false">
                                            </div>
                                        </div>

                                        @if(Auth::user()->role_as == 'vendor')
                                            @foreach($vendor_name as $iv)
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                <label class="form-control-label">Vendor Display Name</label>
                                                <input type="text" name="vendor_name" id="vendor_name" class="form-control form-control-alternative bg-white" value="{{ $iv->vendor_name }}">
                                                </div>
                                            </div>
                                            @endforeach
                                        @elseif(Auth::user()->role_as == NULL)
                                            @if($req_pending)
                                            @else
                                            <div class="col-lg-6">
                                                <div class="form-group mt-4 d-flex pl-0 ml-0">
                                                <a href="#" class="btn btn-sm btn-primary px-3" data-toggle="modal" data-target="#reqvendor">Update</a>
                                                <label class="form-control-label mt-2 pt-1 ml-1">Update to Vendor Account</label>
                                                </div>
                                            </div>
                                            @endif
                                        @endif

                                        @if(Auth::user()->role_as == 'vendor')
                                            @foreach($vendor_name as $iv)
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                <label class="form-control-label">Vendor Description</label>
                                                <input type="hidden" name="user_id" id="user_id" value="{{ $iv->user_id }}" />
                                                <textarea name="description" id="description" rows="4" class="form-control form-control-alternative" placeholder="Vendor Description" spellcheck="false">{{ $iv->description }}</textarea>
                                                </div>
                                            </div>
                                            @endforeach
                                        @else

                                        @endif

                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane animated slideInDown fade" id="contact-just" role="tabpanel" aria-labelledby="contact-tab-just">
                                    <div class="pl-lg-4">

                                    <div class="row">
                                        <div class="col-md-12">
                                        <div class="form-group focused">
                                            <label class="form-control-label">Address 1 (Flat No, Apt No & Address)</label>
                                            <textarea name="address1" id="address1" rows="4" class="form-control form-control-alternative" placeholder="Address 1 (Optional)" spellcheck="false">{{ Auth::user()->address1}}</textarea>
                                        </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                        <div class="form-group focused">
                                            <label class="form-control-label">Address 2 (Landmark, near by)</label>
                                            <textarea name="address2" id="address2" rows="4" class="form-control form-control-alternative" placeholder="Address 2 (Optional)" spellcheck="false">{{ Auth::user()->address2}}</textarea>
                                        </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-lg-4 col-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label">Country (Type '@')</label>
                                            <input type="text" name="country" id="form-autocomplete-country" class="form-control form-control-alternative mdb-autocomplete" placeholder="Country" value="{{ Auth::user()->country}}" spellcheck="false">
                                        </div>
                                        </div>

                                        <div class="col-lg-4 col-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label">City</label>
                                            <input type="text" name="city" id="city" class="form-control form-control-alternative" placeholder="City" value="{{ Auth::user()->city}}" spellcheck="false">
                                        </div>
                                        </div>

                                        <div class="col-lg-4 col-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Postal Code (Zip Code)</label>
                                            <input type="number" id="pincode" name="pincode" class="form-control form-control-alternative" placeholder="Postal Code (Zip Code)" value="{{ Auth::user()->pincode}}">
                                        </div>
                                        </div>

                                        <div class="col-lg-4 col-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label">State</label>
                                            <input type="text" id="state" name="state" class="form-control form-control-alternative" placeholder="State" value="{{ Auth::user()->state}}" spellcheck="false">
                                        </div>
                                        </div>

                                        <div class="col-lg-4 col-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label">Phone Number</label>
                                            <input type="number" id="phone" name="phone" class="form-control form-control-alternative" placeholder="Phone Number" value="{{ Auth::user()->phone}}" spellcheck="false">
                                        </div>
                                        </div>

                                        <div class="col-lg-4 col-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Alternate Phone Number</label>
                                            <input type="number" id="alternate_phone" name="alternate_phone" class="form-control form-control-alternative" placeholder="Alternate Phone Number" value="{{ Auth::user()->alternate_phone}}" spellcheck="false">
                                        </div>
                                        </div>

                                    </div>

                                    </div>
                                </div>

                                </div>

                                <div class="pl-lg-4 mb-4">
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="form-group float-right mt-4">
                                        <button type='reset' id="reset" class='btn rounded btn-secondary' style="outline:none">
                                        Cancel Update
                                        </button>
                                        <button type='submit' id="save" class='btn rounded btn-primary' style="outline:none">
                                        Update Profile
                                        </button>
                                    </div>
                                    </div>
                                </div>
                                </div>

                            </form>


                        </div>

                    </div>
                </div>

            </div>
        </div>

        @include('frontend.user.updatepsw')
        @include('frontend.user.updateimg')
        @include('frontend.user.reqvendor')

    </div>
</body>

@endsection


@section('scripts')

    <!-- Profile pic  JS -->
    <script type="text/javascript" src="{{ asset('assets/js/pro-change.js') }} "></script>

    <!-- Profile pic Modal -->
    <script>
        $(document).ready(function () {

        var modal = document.getElementById("myModal-img");
        var img = document.getElementById("img-preview");
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption-img");

        img.onclick = function(){
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
        }

        var span = document.getElementsByClassName("close-img")[0];

        span.onclick = function() {
        modal.style.display = "none";
        }

        });
    </script>

    <!-- Razor pay methods -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="{{ asset('assets/js/razorpay_reqv.js') }}"></script>

@endsection

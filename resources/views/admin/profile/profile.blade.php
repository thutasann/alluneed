@extends('layouts.admin')

@section('title')
    {{ Auth::user()->name}}
@endsection

@section('content')

        <div class="main-content-pro my-4">
            <div class="row">

                <div class="col-xl-12">
                    <div class="card card-pro">

                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h5 class="mb-0 font-weight-bold text-primary">Account Info</h5>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="#update-password" class="btn btn-sm btn-primary buttonsubs">Update Password?</a>
                                </div>
                            </div>
                        </div>

                        @include('admin.profile.updatepsw-modal')

                        <div class="card-body bg-secondary">

                            {{-- profile pic update --}}
                            <form class="pl-lg-4" method="POST" action="{{url('propic-update')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row pro-change-profile-admin">
                                    <div class="col-md-12">
                                        <div class="preview">
                                            @if(Auth::user()->Image == NULL)
                                                <img id='img-preview' src="{{ asset('assets/img/user.jpg')}}" alt="{{Auth::user()->name}}">
                                            @else
                                                <img id='img-preview' src="{{ asset('uploads/profile/'.Auth::user()->Image)}}" alt="{{Auth::user()->name}}">
                                            @endif
                                        </div>

                                        <!-- Modal Image -->
                                        <div id="myModal-img" class="modal-img">
                                            <span class="close-img">&times;</span>
                                            <img class="modal-content-img" id="img01">
                                            <div id="caption-img"></div>
                                        </div>

                                        <button id="triggerUpload" class="btn rounded btn-choose-img btn-choose-img-pro" type='button' title="Choose Image">
                                            <i class="fas fa-camera-retro text-white"></i>
                                        </button>

                                        <input type="file" id="filePicker" name="Image" class='prochange-input'>
                                        <div class="fileName fileName-pro"></div>

                                        <button type='submit' class='btn rounded bg-gradient-primary text-white btn-update-img'>
                                            Update Image
                                        </button>
                                    </div>
                                </div>

                            </form>

                            @if (session('status-pro'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{session('status-pro')}}
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


                            {{-- profile info update --}}
                            <form class='profile-update' method="POST" action="{{ url('my-profile-update') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}

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
                                                    <div class="form-group">
                                                        <label>First Name</label>
                                                        <input type="text" id="fname" name="fname" class="form-control" placeholder="First Name"  value="{{ Auth::user()->name}}" spellcheck="false" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Last Name</label>
                                                        <input type="text" id="lname" name="lname" class="form-control" placeholder="Last Name" value="{{ Auth::user()->lname}}" spellcheck="false">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Email address</label>
                                                        <input type="email"  class="form-control bg-white" value="{{ Auth::user()->email}}" readonly spellcheck="false">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane animated slideInDown fade" id="contact-just" role="tabpanel" aria-labelledby="contact-tab-just">
                                        <div class="pl-lg-4">

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Address 1 (Flat No, Apt No & Address)</label>
                                                        <textarea name="address1" id="address1" rows="4" class="form-control" placeholder="Address 1 (Optional)" spellcheck="false">{{ Auth::user()->address1}}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Address 2 (Landmark, near by)</label>
                                                        <textarea name="address2" id="address2" rows="4" class="form-control" placeholder="Address 2 (Optional)" spellcheck="false">{{ Auth::user()->address2}}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-4 col-6">
                                                    <div class="form-group">
                                                        <label>Country</label>
                                                        <input type="text" name="country" id="form-autocomplete-country" class="form-control" placeholder="Country" value="{{ Auth::user()->country}}" spellcheck="false">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-6">
                                                    <div class="form-group">
                                                        <label>City</label>
                                                        <input type="text" name="city" id="city" class="form-control" placeholder="City" value="{{ Auth::user()->city}}" spellcheck="false">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-6">
                                                    <div class="form-group">
                                                        <label>Postal code</label>
                                                        <input type="number" id="pincode" name="pincode" class="form-control" placeholder="Postal code" value="{{ Auth::user()->pincode}}" spellcheck="false">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-6">
                                                    <div class="form-group focused">
                                                        <label>State</label>
                                                        <input type="text" id="state" name="state" class="form-control" placeholder="State" value="{{ Auth::user()->state}}" spellcheck="false">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-6">
                                                    <div class="form-group focused">
                                                        <label>Phone Number</label>
                                                        <input type="number" id="phone" name="phone" class="form-control" placeholder="Phone Number" value="{{ Auth::user()->phone}}" spellcheck="false">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-6">
                                                    <div class="form-group">
                                                        <label>Alternate Phone Number</label>
                                                        <input type="number" id="alternate_phone" name="alternate_phone" class="form-control" placeholder="Alternate Phone Number" value="{{ Auth::user()->alternate_phone}}" spellcheck="false">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <div class="pl-lg-4 mb-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button type='submit' class='btn rounded btn-primary mt-4 float-right'>Update Profile</button>
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

@endsection


@section('scripts')

    <script type="text/javascript" src="{{ asset('assets/js/customfile-admin-profile.js') }} "></script>
    <script type="text/javascript" src="{{ asset('assets/js/auto-complete.js') }} "></script>


@endsection

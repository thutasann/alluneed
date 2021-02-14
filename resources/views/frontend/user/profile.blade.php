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

        <!-- info side -->
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

            <div class="card-header text-center border-0 pt-8 pt-md-4">
              <div class="d-flex justify-content-between">
                <a href="#" class="btn btn-sm btn-info mr-4">Connect</a>
                <a href="#" class="btn btn-sm btn-success float-right">Message</a>
              </div>
            </div>

            <div class="card-body pt-0 pt-md-4">
              <div class="row my-1">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center mt-md-0">
                    <div>
                      <span class="heading">22</span>
                      <span class="description">Products</span>
                    </div>
                    <div>
                      <span class="heading">10</span>
                      <span class="description">Customers</span>
                    </div>
                    <div>
                      <span class="heading">89</span>
                      <span class="description">Orders</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-center">
                <h3 class="mb-2">
                    <span class="pro-name" id="pro-name">{{ Auth::user()->name}}</span>
                    @if(Auth::user()->role_as == 'vendor')
                      <span class='roles'>(Vendor)</span>
                    @else
                    @endif
                </h3>
                <div class="h5 my-3">
                  <i class="fas fa-flag blue-text"></i> <span class='country' id="country">{{ Auth::user()->country}}</span>
                </div>
                <div class="h5 mt-2">
                  <i class="fas fa-envelope blue-text"></i> <a href="mailto:{{ Auth::user()->email}}">{{ Auth::user()->email}}</a>
                </div>
                <div class="mt-2">
                  <i class="fas fa-calendar blue-text"></i> Member of ShopNet since {{ date('F j, Y',strtotime(Auth::user()->created_at)) }}
                </div>
                <hr class="my-4">
                <p><i class="fas fa-map-marked blue-text"></i> <span class='address1' id="address1">{{ Auth::user()->address1}}</span></p>
                <a href="#">Show more</a>
              </div>
            </div>
          </div>
        </div>


        <!-- Update side -->
        <div class="col-xl-8 order-xl-1" id="pro-edit">
          <div class="card bg-secondary shadow">

            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-6">
                  <h4 class="mb-0">Account Info</h4>
                </div>
                <div class="col-6 text-right">
                  <a href="#update-password" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalLoginForm">Update Password?</a>
                </div>
              </div>
            </div>

            <div class="card-body bg-secondary">

                @if (session('statuspic'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                      {{session('statuspic')}}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                @endif

                @if(Auth::user()->role_as == 'vendor')
                  <div class="alert alert-info go-vendor">
                      <strong>{{ Auth::user()->name}} </strong> Account is a Vendor account in AllUNeed. You can now upload products in <br> ' Vendor Dashboard ' and sell items in our AllUneed website.
                      <a href="{{ url('/vendor-dashboard') }}" target='_blank' class='btn btn-info py-2 waves-effect'>
                        Go to Vendor Dashboard <i class="fas fa-arrow-alt-circle-right"></i>
                      </a>
                  </div>
                @else
                @endif  
                    
                
                <form class="pl-lg-4" method="POST" action="{{url('propic-update')}}" enctype="multipart/form-data">
                  {{ csrf_field() }}

                  <div class="row pro-change">
                  
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

                        <button id="triggerUpload" class="btn blue-gradient btn-sm rounded btn-choose-img" type='button' title="Choose Image">
                          <i class="fas fa-camera-retro"></i>
                        </button>

                        <input type="file" id="filePicker" name="Image" class='prochange-input'>
                        <div class="fileName"></div>

                        <button type='submit' class='btn rounded bg-gradient-primary text-white btn-update-img'>Update Profile Image</button>

                      </div>

                  </div>
                  
                </form>
            
                <form class='profile-update' method="POST" id="pro_update_form" enctype="multipart/form-data">
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
                                        <div class="form-group focused">
                                            <label class="form-control-label">First Name</label>
                                            <input type="text" id="fname" name="fname" class="form-control form-control-alternative" placeholder="First Name"  value="{{ Auth::user()->name}}" spellcheck="false">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Last Name</label>
                                            <input type="text" id="Iname" name="Iname" class="form-control form-control-alternative" placeholder="Last Name" value="{{ Auth::user()->Iname}}" spellcheck="false">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-email">Email address</label>
                                            <input type="email"  class="form-control form-control-alternative bg-white" value="{{ Auth::user()->email}}" readonly spellcheck="false">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                      <div class="custom-control custom-switch mt-4">
                                        <input type="checkbox" class="custom-control-input" id="customSwitches" name='roles' {{ Auth::user()->role_as == 'vendor' ? 'checked' : ' ' }}>

                                        @if(Auth::user()->role_as == 'vendor')
                                          <label class="custom-control-label" for="customSwitches">Switch to Customer Account</label>
                                        @else
                                          <label class="custom-control-label" for="customSwitches">Switch to Vendor Account</label>
                                        @endif
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane animated slideInDown fade" id="contact-just" role="tabpanel" aria-labelledby="contact-tab-just">
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group focused">
                                            <label class="form-control-label">Address 1 (Flat No, Apt No & Address)</label>
                                            <textarea name="address1" id="address1" rows="4" class="form-control form-control-alternative" placeholder="Address 1 (Optional)" spellcheck="false">{{ Auth::user()->address1}}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group focused">
                                            <label class="form-control-label">Address 2 (Landmark, near by)</label>
                                            <textarea name="address2" id="address2" rows="4" class="form-control form-control-alternative" placeholder="Address 2 (Optional)" spellcheck="false">{{ Auth::user()->address2}}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label">Country</label>
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
                                            <label class="form-control-label">Postal code</label>
                                            <input type="number" id="pincode" name="pincode" class="form-control form-control-alternative" placeholder="Postal code" value="{{ Auth::user()->pincode}}" spellcheck="false">
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

                    <span id="success_message_profile"></span>
                    
                    <!-- button -->
                    <div class="pl-lg-4 mb-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type='submit' id="save" class='btn rounded btn-primary mt-4 float-right'>Update Profile</button>
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

    <!-- Update password -->
    <div class="modal fade" id="modalLoginForm" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <h4 class="modal-title mt-2 w-100 text-center font-weight-bold">Update Password</h4>
                    <button type="button" class="close font-weight-bold" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                </div>
                <form action="{{ url('password-update') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-body mx-3">
                        <div class="md-form mb-4 input-with-pre-icon form-group">
                            <i class="fas fa-envelope input-prefix"></i>
                            <input type="email" class="form-control validate bg-white" value="{{ Auth::user()->email}} " readonly>
                            <label>Your email</label>
                        </div>
                        <div class="md-form mb-4 input-with-pre-icon form-group">
                            <i class="fas fa-lock input-prefix"></i>
                            <input type="password" class="form-control validate" name='newpsw' required>
                            <label>New Password</label>
                        </div>
                        <div class="md-form mb-4 mt-5">
                            <button class="btn btn-primary" type="submit">Update Password</button>
                            <button class="btn btn-secondary" type="reset">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
  </div>

</body>


@endsection

@section('scripts')

  <!-- Profile pic  JS -->
  <script type="text/javascript" src="{{ asset('assets/js/pro-change.js') }} "></script>

  <script>
    // Image Modal
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

@endsection

@extends('layouts.frontend')

@section('title')
    Pyae Thuta
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
                    @if(Auth::user()->Image == NULL)
                        <img id="img-preview" alt="{{Auth::user()->name}}" src="{{ asset('assets/img/user.jpg')}}" class="rounded-circle z-depth-0" width="100px">
                    @else
                        <img id="img-preview" alt="{{Auth::user()->name}}" src="{{ asset('uploads/profile/'.Auth::user()->Image)}}" name="Image">
                    @endif
                  </a>
                </div>
                
                <!-- Modal Image -->
                <div id="myModal-img" class="modal-img">
                  <span class="close-img">&times;</span>
                  <img class="modal-content-img" id="img01">
                  <div id="caption-img"></div>
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
              <div class="row my-3">
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

        <!-- Products side -->
        <div class="col-xl-8 order-xl-1">
            <main id="prodisplay">

                <div class="page-header mb-2 mt-0">
                    <h4 class="page-title text-left font-weight-bolder">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                        <i class="fa fa-bar-chart" aria-hidden="true"></i>
                    </span>Vendor Profile</h4>
                </div>

                <div class="banner-search ">
                    <input type="search" placeholder="Search product in {{Auth::user()->name}} profile ..." id="myInput_hcol" class="rounded  mt-0 banner-search-input" onkeyup="hcolFunction()" />
                </div>

                @foreach($products as $prod_item)
                    @php $name = 'pyae.thuta'; $id = '2' @endphp
                    <article class="card">

                        <figure>
                            <a href="{{url('collection/'.$prod_item->subcategory->category->group->url.'/'.$prod_item->subcategory->category->url.'/'.$prod_item->subcategory->url.'/'.$prod_item->url.'/'.Crypt::encrypt($prod_item->id))}}">
                                <span class="ribbon badge badge-info text-white p-3">{{$prod_item->sale_tag}}</span>
                                <img src="{{ asset('uploads/products/'.$prod_item->prod_image)}}">
                            </a>    
                        </figure>

                        <div class="flex-content">
                            <p class="user pt-2 pb-3">
                                <img class="avatar" src="http://jlantunez.com/imgs/avatar.jpg" alt="Avatar">
                                <strong class="vname"><a href="{{ url('vendor/'.$name. '/' .$id)}}">Pyae Thuta</a></strong>
                                <span class="timeago">16 mins ago &middot; Nike</span>
                            </p>

                            <ul>
                                <li id="prod_name"><strong>Product :</strong>{{$prod_item->name}}</li>
                                <li>   
                                    <strong>Price :</strong><ins>${{number_format($prod_item->offer_price,2)}}</ins>
                                    <small class="ml-2"><del>${{number_format($prod_item->original_price,2)}}</del></small>
                                </li>
                                <li><strong>Brand :</strong>{{$prod_item->subcategory->name}}</li>
                                <li>{!! substr($prod_item->small_description,0,60) !!}...</li>
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


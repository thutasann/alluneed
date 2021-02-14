@extends('layouts.frontend')

@section('title')
    {{$products->meta_title}}
@endsection

@section('meta_desc')
    {{$products->meta_description}}
@endsection

@section('meta_keyword')
    {{$products->meta_keyword}}
@endsection

@section('content')

<div class="pd-wrap">
    <div class="container-fluid product_data">

          <div class="heading-section">
            <div class="bc-icons-2 mb-4">
                <nav>
                    <ol class="breadcrumb bg-light">
                        <li>
                            <a class="link-text font-weight-bolder" href="{{url('collections')}}">Collections</a>
                            <i class="fas fa-angle-right mx-2"></i>
                        </li>
                        <li>
                            <a class="link-text font-weight-bolder" href="{{ url('collection/'.$products->subcategory->category->group->url) }}">
                            {{ $products->subcategory->category->group->name}}</a>
                            <i class="fas fa-angle-right mx-2"></i>
                        </li>
                        <li>
                            <a class="link-text font-weight-bolder" 
                            href="{{url('collection/'.$products->subcategory->category->group->url.'/'.$products->subcategory->category->url) }}">
                            {{ $products->subcategory->category->name}}</a>
                            <i class="fas fa-angle-right mx-2"></i>
                        </li>
                        <li>
                            <a class="link-text font-weight-bolder" 
                            href="{{url('collection/'.$products->subcategory->category->group->url.'/'.$products->subcategory->category->url.'/'.$products->subcategory->url) }}">
                            {{ $products->subcategory->name}}</a>
                            <i class="fas fa-angle-right mx-2"></i>
                        </li>
                    
                        <li class="active">
                            {{$products->name}}
                        </li>

                    </ol>
                </nav>
            </div>
          </div>

          <div class="row">
            <!-- image -->
            <div class="col-md-5">
                <div class="border rounded">
                    <img src="{{ asset('uploads/products/'.$products->prod_image)}}" class="w-100 rounded img-fluid">
                </div>
                <div class='my-2'>
                    <a href="" class='py-3'>
                    <img src="{{ asset('assets/img/user.jpg')}}" alt="vendor image" class='user-img' title='Vendor'>
                    <span class='name ml-1 mt-2'>Thuta Sann</span>
                    </a>
                </div>
            </div>

            <!-- product detail -->
            <div class="col-md-7">
              <div class="product-dtl">

                <!-- name,like,review -->
                <div class="product-info">

                  <div class="product-name product-heading">
                    {{$products->name}}
                    <small class='font-italic badge sale-tag badge-primary px-2 py-2 ml-2 mt-0'>{{$products->sale_tag}}</small>
                  </div>
                  
                  <div class="reviews-counter mt-4">
                    <div class="love-form rate">
                      <input type="hidden" class="prod_id" name="prod_id" id="prod_id" value="{{$products->id}}">
                      <input type="hidden" class="user_id" name="user_id" id="user_id" value="{{Auth::user()->id}}">

                      @php $l_totoal= "0"; @endphp
                      @foreach($countlike as $i)
                        @php $l_totoal = $l_totoal +1; @endphp
                      @endforeach

                      @php $r_totoal= "0"; @endphp
                      @foreach($review as $i)
                          @php
                              $r_totoal = $r_totoal +1;
                          @endphp
                      @endforeach

                      <div class='like_unlike' id="like_unlike">

                        @if(count($likecount) > 0)
                          <span class="unlike" id="unlike"><i class="fas fa-heart"></i></span>
                        @else
                          <span class="like" id="like"><i class="far fa-heart"></i></span>  
                        @endif

                        <br>

                        <span class="likes_count toolip">
                          @if(count($likecount) > 0)
                            You and {{ number_format($l_totoal)-1 }} others
                          @else
                            {{ number_format($l_totoal) }} likes
                          @endif

                          <span class="toolist">
                            <ul>
                              @foreach($reactors as $r)
                              <li>
                                <a href="" class="text-white">{{$r->users->name}}</a>
                              </li>
                              @endforeach
                              
                            </ul>
                          </span>
                        </span>

                      
                      </div>
                    </div>
                  </div>
                  
                  <div class="product-price-discount product-price">
                        <span class='offer-price'>${{number_format($products->offer_price),2}}</span>
                        <span class='selling-price line-through'><s>${{number_format($products->original_price),2}}</s></span>
                  </div>
                </div>

                <!-- quantity -->
                <div class="py-3">
                    <div class="row">
                        <input type="hidden" class="product_id" value="{{$products->id}}">
                        <div class="number-input col-md-12">

                            <button class='btn-qty btn-minus mt-2' onclick="this.parentNode.querySelector('input[type=number]').stepDown()" >-</button>
                                <input type="number" class='qty-input quantity text-center mt-2' value="1" min="1" max="{{$products->quantity}}">
                            <button class='btn-qty btn-plus mt-2' onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus">+</button>
                            
                            <button type="button" class="add-to-cart-btn btn btn-info mt-2 ml-4 py-2 px-3">Add To Cart</button>
                            <button type="button" class="add-to-wishlist-btn btn btn-danger shadow ml-1 py-2 px-3 mt-2"><i class="fas fa-heart"></i> Add to Wishlist</button> 
                        </div>
                    </div>
                    
                </div>

                <div class="product-small-description py-2 border-top">
                    <p>
                      @if ($products->small_description !== NULL)
                        {!! $products->small_description !!}
                      @endif
                    </p>
                </div>

              </div>
            </div>

          </div>

          <div class="product-info-tabs my-5">

            <ul class="nav nav-tabs" id="myTab" role="tablist">

                @if ($products->p_highlight_heading !== NULL)
                  <li class="nav-item">
                    <a class="nav-link active" id="highlight-tab" data-toggle="tab" href="#highlight" role="tab" aria-controls="highlight" aria-selected="true">
                      {{$products->p_highlight_heading}}
                    </a>
                  </li>
                @endif

                @if($products->p_description_heading !== NULL)
                  <li class="nav-item">
                    <a class="nav-link" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="false">
                      {{$products->p_description_heading}}
                    </a>
                  </li>
                @endif

                @if ($products->p_details_heading !== NULL)
                  <li class="nav-item">
                    <a class="nav-link" id="specification-tab" data-toggle="tab" href="#specification" role="tab" aria-controls="specification" aria-selected="false">
                      {{$products->p_details_heading}}
                    </a>
                  </li>
                @endif
                
                <li class="nav-item">
                  <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">
                    Reviews <span id="review_no_load"><span class='review_no badge badge-info py-1 px-1'>{{ number_format($r_totoal) }}</span></span>
                  </a>
                </li>

            </ul>

            <div class="tab-content" id="myTabContent">
                
                @if (!$products->p_highlights !== NULL)
                  <div class="tab-pane fade show active" id="highlight" role="tabpanel" aria-labelledby="highlight-tab">
                      <p>{!! $products->p_highlights!!}</p>
                  </div>
                @endif
                
                @if ($products->p_description !== NULL)
                  <div class="tab-pane fade" id="description" role="tabpanel" aria-labelledby="description-tab">
                      <p>{!! $products->p_description !!}</p>
                  </div>
                @endif

                @if ($products->p_details !== NULL)
                  <div class="tab-pane fade" id="specification" role="tabpanel" aria-labelledby="specification-tab">
                      <p>{!! $products->p_details !!}</p>
                  </div>
                @endif

                <div class="tab-pane fade comment-box accordion" id="review" role="tabpanel" aria-labelledby="review-tab">

                  <!-- progress -->
                  <div class="form-group" id="process_review" style="display:none;">
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="">
                        </div>
                    </div>
                  </div>
                  <span id="success_message_review"></span>

                  <!-- comment box -->
                  <div class="comment-section">
                    <span class="comment-section-title text-info">Reviews</span>
                    <span class="new-comment-button" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Write Review</span>
                          
                    <div id="collapseOne" class="collapse collapse-review" aria-labelledby="headingOne" data-parent="#review">
                      <form class="review-form bg-secondary py-3 px-3" method='POST' id="review_form">
                        {{ csrf_field() }}

                        <input type="hidden" id="user_id" value='{{ Auth::user()->id}}' name='user_id'>
                        <input type="hidden" id="prod_id" value='{{$products->id}}' name='prod_id'>

                        <div class="row">
                          <div class="col-md-12">
                            <section class="my-2">
                              <div class="d-md-flex flex-md-fill mt-4 px-1 form-group">
                                <div class="d-flex justify-content-center mr-md-3">
                                  <img class="card-img-100 z-depth-1 mb-4" src="{{ asset('uploads/profile/'.Auth::user()->Image) }}" alt="reviewer">
                                </div>
                                <textarea name="review" id="review" class="form-control pl-3 pt-3 form-control form-control-alternative" rows="6" placeholder="Write something here..." spellcheck="false"></textarea>
                              </div>
                              <span id="review_error" class="text-danger mb-4"></span>
                            </section>
                          </div>
                        </div>
                        <button class="btn btn-primary waves-effect" type='submit' id="save">Submit Review</button>
                      </form>
                    </div>                    
                  </div>

                  <!-- comments -->
                  @foreach ($review as $i)
                  <div id="review-sec">
                    <section class="my-3 comment-list">
                        <div class="card-header bg-secondary border-0 font-weight-bold d-flex justify-content-between">
                          <p class="mr-4 mb-0">About the reviewer:</p>
                          <ul class="list-unstyled list-inline mb-0">
                            <li class="list-inline-item"><a href="" class="text-default mr-3"><i class="fas fa-envelope mr-1"></i></a></li>
                            <li class="list-inline-item"><a href="" class="text-default mr-3"><i class="fas fa-user mr-1"></i></a></li>
                            <li class="list-inline-item"><a href="" class="text-default mr-3"><i class="fas fa-rss mr-1"></i></a></li>
                          </ul>
                        </div>
                        <div class="media mt-3 px-1">
                          <img class="card-img-100 rounded-circle d-flex z-depth-1 mr-3" src="{{ asset('uploads/profile/'.$i->users->Image)}}">
                          <div class="media-body">
                            <h5 class="font-weight-bold mt-0">
                              <a class="text-default" href="">{{$i->users->name}}
                              <span class="comment-time">– {{ date('F j, Y, g:i a',strtotime($i->created_at)) }}</span>
                              </a>
                            </h5>
                            <p class="js-excerpt excerpt-hidden">{{$i->review}}</p>
                          </div>
                          <a role="button" href="#" class="js-show-more">Show more</a>
                        </div>
                    </section>
                  </div>
                  @endforeach

                 
                </div>
                
            </div>

          </div>

          
          <!-- Recommended Products -->
          @if(count($recom_prod)>0)

          <div id="recommend">

            <section class="infinite-sec my-3 py-5">

              <div class="page-header mb-4 mt-0">
                <h4 class="page-title text-center font-weight-bolder">
                  <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="fa fa-bar-chart" aria-hidden="true"></i>
                  </span> Recommended For You </h4>
              </div>

              <div class="text-center p-3 mb-5">
                  <button class="btn bg-gradient-info text-white rounded toggle-all">
                    <i class="fas fa-th" aria-hidden="true"></i> Show List
                  </button>
              </div>


              <div id="infinite_carousel" class="d-flex align-items-center slide off-slide">

                  <div class="p-3 control"><i class="fa fa-2x fa-chevron-left"></i></div>

                  <div class="row w-100 flex-nowrap mx-1">

                    @foreach($recom_prod as $i)
                      <div class="col-6 col-sm-4 col-md-3 col-xl-2 text-center infi-item">
                          <div class='infi-dtl rounded waves-effect'>
                            <a href="{{url('collection/'.$i->subcategory->category->group->url.'/'.$i->subcategory->category->url.'/'.$i->subcategory->url.'/'.$i->url.'/'.Crypt::encrypt($i->id)) }}">
                              <img class="d-block mx-auto img-fluid mb-3" src="{{ asset('uploads/products/'.$i->prod_image)}}">
                              <hr>
                              <span class="infi-name">{{$i->name}}</span>
                            </a>
                          </div>
                      </div>
                    @endforeach

                  </div>

                  <div class="p-3 control"><i class="fa fa-2x fa-chevron-right"></i></div>
              </div>

            </section>

          </div>
          
          @endif
          
    </div>
</div>

@endsection




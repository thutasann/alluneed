@extends('layouts.frontend')

@section('title')
    @foreach($productsearch as $item)
        {{$item->name}}
    @endforeach
@endsection
	
@section('content')

    <section class="py-3 my-5">
		<div class="site">
			<div id="main">
			    <div class="section">
					<div class="container-fluid">
						<div class="row">

							@include('layouts.inc.front-sidebar')

							<div class="col-lg-9">
									<div class="row">
                                        @foreach($productsearch as $item)
											<div class="col-lg-4">
												<div class="product-item">
                                                    <span class="onsale badge" title="Sale Tag">{{$item->sale_tag}}</span>
                                                    
													<div class="thumb">
														<a href="shop-detail.html">
															<img src="{{ asset('uploads/products/'.$item->prod_image) }}" alt="{{$item->sale_tag}}">
														</a>
														<div class="extra">
															<div>
																<p><i class="pe-7s-cart"></i><a href="#" class="btn-shop">Add to cart</a></p>
																<p>
																	<i class="pe-7s-search"></i>
																	<a class="btn-shop" href="{{url('collection/'.$item->subcategory->category->group->url.'/'.$item->subcategory->category->url.'/'.$item->subcategory->url.'/'.$item->url.'/'.Crypt::encrypt($item->id) )}}">View item</a>
																</p>
															</div>
														</div>
                                                    </div>

                                                    <div class="info-sec">
                                                        <a href="{{url('collection/'.$item->subcategory->category->group->url.'/'.$item->subcategory->category->url.'/'.$item->subcategory->url.'/'.$item->url.'/'.Crypt::encrypt($item->id) )}}" class='pro-name'>
                                                            <h3 class="text-center">{{$item->name}}</h3>
                                                        </a>

                                                        <span class="price">
                                                            <ins>${{number_format($item->offer_price,2)}}</ins>
                                                            <del>${{number_format($item->original_price,2)}}</del>
                                                        </span>

                                                        <span class="brand">
                                                            <strong>Brand : </strong> {{$item->subcategory->name}} |
                                                            <strong>Category : </strong> {{$item->subcategory->category->name}}
                                                        </span>
                                                        
                                                    </div>
												</div>
                                            </div>
                                        @endforeach
									</div>
                            </div>
                            
						</div>
					</div>
			    </div>
			</div>
		</div>
	</section>

@endsection
@extends('layouts.frontend')

@section('title')
    Collection - Category - SubCategory - Products
@endsection
	
@section('content')

<section class="container-fluid py-3">

    <div class="bc-icons-2 mb-4">
        <nav>
            <ol class="breadcrumb bg-light">
                <li>
                    <a class="link-text font-weight-bolder" href="{{url('collections')}}">Collections</a>
                    <i class="fas fa-angle-right mx-2"></i>
                </li>
                <li>
                    <a class="link-text font-weight-bolder" href="{{url('collection/'.$subcategory->category->group->url)}}">
                    {{$subcategory->category->group->name}}</a>
                    <i class="fas fa-angle-right mx-2"></i>
                </li>
                <li>
                    <a class="link-text font-weight-bolder" href="{{url('collection/'.$subcategory->category->group->url.'/'.$subcategory->category->url)}}">
                    {{$subcategory->category->name}}</a>
                    <i class="fas fa-angle-right mx-2"></i>
                </li>
            
                <li class="active">
                    {{$subcategory->name}}
                </li>

                @if(isset($_GET["q"]))
                    <li class="active font-weight-bolder underline">
                        <i class="fas fa-angle-right mx-2"></i>
                        [ Showing Result From : {{$_GET["q"]}} ]
                    </li>
                @endif

                @if(isset($_GET["sort"]))

                    <li class="active font-weight-bolder underline">
                        <i class="fas fa-angle-right mx-2"></i>
                        @if($_GET["sort"] == 'price_asc')

                            [ Sorting Result From : Price - Low to High ]

                        @elseif($_GET["sort"] == 'price_desc')

                            [ Sorting Result From : Price - High to Low ]

                        @elseif($_GET["sort"] == 'newest')
                            
                            [ Sorting Result From : Newest ]
                        
                        @elseif($_GET["sort"] == 'popularity')
                            
                            [ Sorting Result From : Popularity ]

                        @endif
                    </li>
                
                @endif

                @if(isset($_GET["prod_tag"]))
                    <li class="active font-weight-bolder underline">
                        <i class="fas fa-angle-right mx-2"></i>
                        @if($_GET["prod_tag"] == 'new_arrival')

                            [ Product Tag Result From : New Arrival ]

                        @elseif($_GET["prod_tag"] == 'featured_products')

                            [ Product Tag Result From : Featured Products ]
                        
                        @elseif($_GET["prod_tag"] == 'popular_products')

                            [ Product Tag Result From : Popular Products ]

                        @elseif($_GET["prod_tag"] == 'offers_products')

                            [ Product Tag Result From : Offers Products ]

                        @endif
                    </li>
                @endif




            </ol>
        </nav>
    </div>

    <div class="row d-none">
        <div class="col-md-12">
            <form action="{{ URL::current() }}" method="GET">
                <div class="card">
                    <div class="card-header shadow-none">
                        <h5>Brands <button type="submit" class="btn btn-primary btn-sm float-right">Filter</button></h5>
                        <div class="d-flex card body shadow-none">
                            @foreach ($subcategorylist as $item)
                                @php
                                    $checked = [];
                                    if(isset($_GET['filterbrand']))    
                                    {
                                        $checked = $_GET['filterbrand'];
                                    }
                                @endphp
                                <div class="mb-1">
                                    <input type="checkbox" name="filterbrand[]"  value="{{ $item->name }}" 
                                        @if (in_array($item->name, $checked )) checked @endif
                                    /> 
                                    {{ $item->name }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">

        <div class="col-lg-3 pt-3 site">
            <div class="sidebar pro-sidebar">

                <form method="GET" action="{{ URL::current() }}">
                    {{ csrf_field() }}
                    <div class="widget">
                        <input type="search" class="search-field" placeholder="Search {{$subcategory->name}}.." name="q" >
                    </div>
                </form>

                <div class="widget">
                    <h3 class="widget-title font-weight-bold"><i class="fas fa-sort"></i> Sort By :</h3>
                    <ul>
                        <li>
                            <a href='{{ URL::current() }}' class='py-1 text-dark d-block waves-effect sort-font'>All</a>
                        </li>
                        <li>
                            <a href='{{ URL::current()."?sort=price_asc" }}' class='py-1 text-dark d-block waves-effect sort-font'>Price - Low to High</a>
                        </li>
                        <li>
                            <a href='{{ URL::current()."?sort=price_desc" }}' class='py-1 text-dark d-block waves-effect sort-font'>Price - High to Low</a>
                        </li>
                        <li>
                            <a href='{{ URL::current()."?sort=newest" }}' class='py-1 text-dark d-block waves-effect sort-font'>Newest</a>
                        </li>
                        <li>
                            <a href='{{ URL::current()."?sort=popularity" }}' class='py-1 text-dark d-block waves-effect sort-font'>Popularity</a>
                        </li>
                    </ul>
                </div>

                <div class="widget mt-3 widget-tag-cloud">
                    <h3 class="widget-title font-weight-bold"><i class="fas fa-tags"></i> Product Tags</h3>
                    <div class="tagcloud">
                        <a href='{{ URL::current()."?prod_tag=new_arrival" }}'>New Arrival</a>
                        <a href='{{ URL::current()."?prod_tag=featured_products" }}'>Featured</a>
                        <a href='{{ URL::current()."?prod_tag=popular_products" }}'>Popular</a>
                        <a href='{{ URL::current()."?prod_tag=offers_products" }}'>Offers Products</a>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="col-lg-9">
            <main id="prodisplay" class="pt-3 product_data">

                @foreach($products as $prod_item)
                
                    @php 
                        $name = 'pyae.thuta'; $id = '2';
                        $cutdesc = substr($prod_item->small_description,0,60);
                    @endphp

                    <article class="card">

                        <figure>

                            <a href="{{url('collection/'.$prod_item->subcategory->category->group->url.'/'.$prod_item->subcategory->category->url.'/'.$prod_item->subcategory->url.'/'.$prod_item->url.'/'.Crypt::encrypt($prod_item->id))}}">
                                <span class="ribbon badge badge-info text-white p-3">{{$prod_item->sale_tag}}</span>
                                <img src="{{ asset('uploads/products/'.$prod_item->prod_image)}}">
                            </a>    

                            {{-- <input type="hidden" class="product_id" value="{{$prod_item->id}}">

                            @guest
                                <a href="{{ url('/login') }}" class="btn btn-danger btn-block shadow text-white" style="font-size: 12px;">
                                    <i class="fas fa-heart"></i> Add to Wishlist
                                </a>    
                            @else 
                                <button type="button" class="add-to-wishlist-btn btn btn-danger btn-block shadow">
                                    <i class="fas fa-heart"></i> Add to Wishlist
                                </button>   
                            @endguest --}}

                        </figure>

                        <div class="flex-content">
                            <p class="user pt-2 pb-3">
                                <a class="button" href="#">Follow</a>
                                <img class="avatar" src="http://jlantunez.com/imgs/avatar.jpg" alt="Avatar">
                                <strong class="vname"><a href="{{ url('vendor/'.$name.'.'.$id)}}">Pyae Thuta</a></strong>
                                <span class="timeago">16 mins ago &middot; Nike</span>
                            </p>

                            <ul>
                                <li id="prod_name"><strong>Product :</strong>{{$prod_item->name}} {{ $prod_item->id }}</li>
                                <li>   
                                    <strong>Price :</strong><ins>${{number_format($prod_item->offer_price,2)}}</ins>
                                    <small class="ml-2"><del>${{number_format($prod_item->original_price,2)}}</del></small>
                                </li>
                                <li><strong>Brand :</strong>{{$subcategory->name}}</li>
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

</section>

@endsection


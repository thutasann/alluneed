@extends('layouts.frontend')

@include('layouts.inc.encrypt')


@section('title')
    {{$subcategory->name}}
@endsection

@section('content')

<section class="container-fluid py-3">

    <div class="bc-icons-2 mb-4">
        <nav>
            <ol class="breadcrumb bg-secondary">

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

                <div class="widget">
                    <form action="{{ URL::current() }}" method="GET">
                        <h3 class="widget-title font-weight-bold">
                            <i class="fas fa-sliders-h"></i>
                            Brand <button type="submit" class="btn btn-sm ml-3 bg-gradient-primary text-white">Filter</button>
                        </h3>
                        <ul>
                            @foreach($subcategorylist as $itemcate)
                                @php
                                    $checked = [];
                                    if(isset($_GET['filterbrand']))
                                    {
                                        $checked = $_GET['filterbrand'];
                                    }
                                @endphp
                                <li>
                                    <label class="container-check">{{ $itemcate->name }}
                                        <input type="checkbox" name="filterbrand[]" value="{{ $itemcate->name }}"
                                            @if(in_array($itemcate->name, $checked)) checked @endif
                                        />
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </form>
                </div>

            </div>
        </div>

        <div class="col-lg-9">
            <main id="prodisplay" class="pt-3 product_data">

                @foreach($products as $prod_item)

                    @php
                        $truncated = Illuminate\Support\Str::limit($prod_item->small_description, 450);
                        $encrypted = encrypt_decrypt('encrypt', $prod_item->vendor_id);
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


                                <a href="#">
                                    <img src="{{ asset('assets/img/user.jpg')}}" class="avatar" alt="Vendor" title="Vendor">
                                </a>

                                <strong class="vname">
                                    <a href="" class="text-primary">
                                        Vendor
                                    </a>
                                </strong>

                                <span class="timeago">
                                    {{$prod_item->created_at->diffForHumans()}} &middot; {{$subcategory->name}}
                                </span>

                            </p>

                            <ul>
                                <li id="prod_name"><strong>Name :</strong>{{$prod_item->name}}</li>
                                <li>
                                    <strong>Price :</strong><ins>${{number_format($prod_item->offer_price,2)}}</ins>
                                    <small class="ml-2"><del>${{number_format($prod_item->original_price,2)}}</del></small>
                                </li>
                                <li><strong>Brand :</strong>{{$subcategory->name}}</li>
                                <li>{{ strip_tags($truncated) }}...</li>
                            </ul>

                            <footer>
                                <p>
                                    <a class="bg-gradient-info btn text-white rounded" href="{{url('collection/'.$prod_item->subcategory->category->group->url.'/'.$prod_item->subcategory->category->url.'/'.$prod_item->subcategory->url.'/'.$prod_item->url.'/'.Crypt::encrypt($prod_item->id))}}">
                                        View Detail
                                    </a>
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

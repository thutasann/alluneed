@extends('layouts.frontend')

@section('title')
    {{ $slider->heading }}
@endsection

@include('layouts.inc.encrypt')


@section('content')

    <header>
        <div id="header-hero">
            <div class="header-bg">
                <img src="{{ asset('uploads/slider/'.$slider->image) }}" alt="{{ $slider->heading }}" title="{{ $slider->heading }}" />
            </div>
            <div class="header-content">
                <p class="heading-1 bg-gradient-info">{{ $vendor->vendor_name }}</p>
                <h1>{{ $slider->heading }}</h1>
                <p class="description">{{ $slider->description }}</p>
                <div class="button-ad bg-gradient-primary">
                    <a href="#explore">{{ $slider->link_name }}</a>
                </div>
            </div>
        </div>
    </header>

    <div id="explore">
        <section id="summer-collection">
            <div class="container">
                <div class="sc-content">
                    <h1>{{ $vendor->vendor_name }}</h1>
                    <p class="description">{{ $vendor->description }}</p>
                    @php
                        $encrypted = encrypt_decrypt('encrypt', $user->id);
                        $slname   = preg_replace('/[^a-z0-9]+/i', '_', trim(strtolower($vendor->vendor_name)));
                    @endphp
                    <a href="{{ url('vp/'.$slname.'/'.$encrypted)}}" target="_blank" class="text-primary">
                        View Profile <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                <div class="sc-media">
                    <div class="sc-media-bg">
                        @if($user->Image == NULL)
                            <img class="rounded" src="{{ asset('assets/img/user.jpg')}}" alt="{{ $vendor->vendor_name }}" title="{{ $vendor->vendor_name }}" >
                        @else
                            <img class="rounded" src="{{ asset('uploads/profile/'.$user->Image) }}" alt="{{ $vendor->vendor_name }}" title="{{ $vendor->vendor_name }}" />
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>

    <section id="products">
        <div class="container">

            <div class="products-header">
                <h2>Products</h2>
                <p>Here are the products provided in <span class="text-primary font-weight-bold">{{ $slider->heading }}</span>.</p>
            </div>

            @foreach($slider_products as $i)
                <a href="{{url('collection/'.$i->product->subcategory->category->group->url.'/'.$i->product->subcategory->category->url.'/'.$i->product->subcategory->url.'/'.$i->product->url.'/'.Crypt::encrypt($i->product->id))}}" target="_blank">
                    <div class="product">
                        <figure>
                            <img class="rounded" src="{{ asset('uploads/products/prod/'.$i->product->prod_image)}}" alt="{{ $i->product->name }}" title="{{ $i->product->name }}" />
                            <span class="ribbon badge badge-info text-white p-2">{{$i->product->sale_tag}}</span>

                            <figcaption>
                                {{ $i->product->name }}
                            </figcaption>

                            <figcaption class="text-primary">
                                ${{number_format($i->product->offer_price,2)}}
                            </figcaption>

                        </figure>
                    </div>
                </a>
            @endforeach

        </div>
    </section>

@endsection

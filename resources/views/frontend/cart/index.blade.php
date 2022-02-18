@extends('layouts.frontend')

@section('title')
    Your Cart
@endsection


@section('content')
    <div class="px-4 px-lg-0">
        <div class="pb-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 rounded mb-3">

                        @if(isset($cart_data))
                            @if(Cookie::get('shopping_cart'))

                                @php
                                    $total="0";
                                    $itemno = "0";
                                @endphp

                                <div class="shopping-cart">
                                    <div class="shopping-cart-table">

                                            <!-- header -->
                                            <div class="page-header px-4 mb-2 mt-4">
                                                <h4 class="page-title font-weight-bolder">
                                                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                                                        <i class="fa fa-bar-chart" aria-hidden="true"></i>
                                                    </span>
                                                    Your cart
                                                </h4>
                                            </div>

                                            <!-- continue / clear  -->
                                            <div class="p-4">
                                                <a href="{{ url('collections') }}" class="mb-4 ml-0 mr-0 float-left btn btn-upper bg-gradient-primary text-white rounded ">
                                                    Continue Shopping
                                                </a>

                                                <a href="javascript:void(0)" class="mb-4 mr-0 float-right clear_cart btn bg-gradient-danger text-white rounded btn-upper">
                                                    Clear Cart
                                                </a>
                                            </div>

                                            <!-- table -->
                                            <div class="py-1 p-4 table-responsive-vertical">
                                                <table id="table" class="table table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" class="font-weight-bold text-uppercase border-0 cart-description">Item</th>
                                                            <th scope="col" class="font-weight-bold text-uppercase border-0 cart-description">Image</th>
                                                            <th scope="col" class="font-weight-bold text-uppercase border-0 cart-product-name">Product Name</th>
                                                            <th scope="col" class="font-weight-bold text-uppercase border-0 cart-vendor-name">Seller Name</th>
                                                            <th scope="col" class="font-weight-bold text-uppercase border-0 cart-price">Price</th>
                                                            <th scope="col" class="font-weight-bold text-uppercase border-0 cart-qty">Quantity</th>
                                                            <th scope="col" class="font-weight-bold text-uppercase border-0 cart-total">Total</th>
                                                            <th scope="col" class="font-weight-bold text-uppercase border-0 cart-romove">Remove</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody class="my-auto">
                                                        @foreach ($cart_data as $data)
                                                        @php $itemno = $itemno +1; @endphp
                                                        <tr class="cartpage">

                                                            <td data-title="Item" class="cart-product-sub-total">
                                                                <span class="cart-sub-total-price">{{ $itemno }}</span>
                                                            </td>

                                                            <td data-title="Image" class="cart-image">
                                                                <a class="entry-thumbnail" href="javascript:void(0)">
                                                                    <img src="{{ asset('uploads/products/prod/'.$data['item_image']) }}" width="70" class="img-fluid rounded shadow-sm" title="{{ $data['item_name'] }}" alt="{{ $data['item_name'] }}">
                                                                </a>
                                                            </td>

                                                            <td data-title="Product" class="cart-product-name-info">
                                                                <h6 class='cart-product-description font-weight-bolder'>
                                                                    <a href="javascript:void(0)">
                                                                        {{ $data['item_name'] }}
                                                                    </a>
                                                                </h6>
                                                            </td>

                                                            <td data-title="Seller" class="cart-vendor-name-info">
                                                                <h6 class='cart-product-description font-weight-bolder'>
                                                                    <a href="javascript:void(0)">
                                                                        {{ $data['vendor_name'] }}
                                                                    </a>
                                                                </h6>
                                                            </td>

                                                            <td data-title="Price" class="cart-product-sub-total">
                                                                <span class="cart-sub-total-price">$ {{ number_format($data['item_price'], 2) }}</span>
                                                            </td>

                                                            <td data-title="Quantity" class="cart-product-quantity">
                                                                <input type="hidden" class="product_id" value="{{ $data['item_id'] }}" >

                                                                <div class="number-input quantity">
                                                                    <button class='btn-qty btn-minus changeQuantity' onclick="this.parentNode.querySelector('input[type=number]').stepDown()" >-</button>
                                                                        <input type="number" class='qty-input quantity text-center' maxlength="2" max="10" value="{{$data['item_quantity']}}">
                                                                    <button class='btn-qty btn-plus changeQuantity' onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus">+</button>
                                                                </div>
                                                            </td>

                                                            <td data-title="Total" class="cart-product-grand-total">
                                                                $ <span class="cart-grand-total-price"> {{ number_format($data['item_quantity'] * $data['item_price'], 2) }}</span>
                                                            </td>

                                                            <td data-title="Remove">
                                                                <button type="button" class="badge badge-pill bg-gradient-danger btn px-3 py-2 delete_cart_data">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </td>
                                                            @php $total = $total + ($data["item_quantity"] * $data["item_price"]) @endphp
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            <!-- summary -->
                                            <div class="row py-1 p-4 ">

                                                <div class="col-lg-6 order-lg-1 order-2">

                                                    <section class="infinite-sec">

                                                        <div class="page-header mb-4 mt-0">
                                                            <h4 class="page-title text-center font-weight-bolder">
                                                            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                                                            <i class="fa fa-bar-chart" aria-hidden="true"></i>
                                                            </span> Your Recently viewd items </h4>
                                                        </div>

                                                        @php
                                                            $slname   = preg_replace('/[^a-z0-9]+/i', '.', trim(strtolower(Auth::user()->name)));
                                                        @endphp

                                                        <div class="text-center p-3 mb-5">
                                                            <button class="btn bg-gradient-info text-white rounded toggle-all">
                                                                <i class="fas fa-th"></i> Show List
                                                            </button>
                                                            <a class="btn view-hall bg-gradient-primary text-white rounded" href="{{ url('activityall/'.$slname.'?activitytag=prod_detail' ) }}">
                                                                <i class="fas fa-history"></i>&nbsp; Items Browsing History
                                                            </a>
                                                        </div>

                                                        <div id="infinite_carousel" class="d-flex align-items-center slide off-slide">

                                                            <div class="p-3 control"><i class="fa fa-2x fa-chevron-left"></i></div>

                                                            <div class="row w-100  flex-nowrap mx-1">

                                                            @foreach($recent_prod as $i)
                                                                <div class="col-6 col-sm-4 col-md-3 col-xl-6 text-center infi-item">
                                                                    <div class='infi-dtl rounded waves-effect'>
                                                                        <a href="{{url('collection/'.$i->products->subcategory->category->group->url.'/'.$i->products->subcategory->category->url.'/'.$i->products->subcategory->url.'/'.$i->products->url.'/'.Crypt::encrypt($i->products->id)) }}">
                                                                            <img class="d-block mx-auto img-fluid mb-3 animated fadeIn" src="{{ asset('uploads/products/prod/'.$i->products->prod_image)}}">
                                                                            <hr>
                                                                        <span class="infi-name animated fadeIn">{{$i->products->name}}</span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            @endforeach

                                                            </div>

                                                            <div class="p-3 control"><i class="fa fa-2x fa-chevron-right"></i></div>

                                                        </div>

                                                    </section>

                                                </div>

                                                <div class="col-lg-6 order-lg-2 order-1 mb-5">
                                                        <div class="bg-light px-4 py-3 text-uppercase font-weight-bold">
                                                            Order summary
                                                        </div>

                                                        <div class="p-4" id='totalajaxcall'>
                                                            <p class="font-italic mb-4 font-weight-bolder">Tax Amount calculated based on values you have entered.</p>

                                                            <ul class="list-unstyled mb-4 totalpricingload">

                                                                <li class="d-flex justify-content-between py-3 border-bottom">
                                                                    <strong class="text-muted cart-grand-name">Grand Total</strong>
                                                                    <h5 class="cart-grand-price">
                                                                        <strong class="cart-grand-price-viewajax">${{ number_format($total, 2) }}</strong>
                                                                    </h5>
                                                                </li>
                                                            </ul>

                                                        </div>

                                                        <div class="cart-checkout-btn text-center">
                                                            @if (Auth::user())
                                                                <a href="{{ url('checkout') }}" class="btn bg-gradient-success text-white  rounded-pill px-3 py-3 btn-block checkout-btn">Procceed to checkout</a>
                                                            @else
                                                                <a href="{{ url('login') }}" class="btn bg-gradient-success text-white  rounded-pill px-3 py-3 btn-block checkout-btn">Procceed to checkout</a>
                                                            @endif
                                                        </div>
                                                </div>

                                            </div>

                                    </div>
                                </div>

                            @endif

                        @else
                            <div class="row">
                                <div class="col-md-12 mycard py-3 text-center">
                                    <div class="mycards">
                                        <h4 class="font-weight-bolder mb-5 mt-3 empty-header">Your cart is currently empty.</h4>
                                        <img src="{{ asset('assets/img/empty-cart.png')}}" class="mt-4">
                                        <a href="{{ url('collections') }}" class="mt-4 btn btn-upper bg-gradient-primary text-white outer-left-xs rounded">Continue Shopping</a>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

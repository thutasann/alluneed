@extends('layouts.frontend')

@section('title')
    Checkout
@endsection

@section('content')

<div class="px-4 px-lg-0">
    <div class="pb-5">
        <div class="container-fluid">
            <div class="row">

                <!-- header -->
                <div class="page-header col-lg-12 px-4 mb-4 mt-4">
                    <h4 class="page-title font-weight-bolder">
                        <span class="page-title-icon bg-gradient-primary text-white mr-2">
                            <i class="fa fa-bar-chart" aria-hidden="true"></i>
                        </span>
                        Checkout
                    </h4>
                </div>

                <!-- user info -->
                <div class="col-lg-6 mb-4 px-4">

                    <p class='text-muted font-weight-bolder mb-4 mt-3'>You can Edit your Info below.
                        @php
                        $today = Carbon\Carbon::today()->format('Y-m-d h:i:s');
                        @endphp
                        <span>{{ $today }}</span>
                    </p>

                    <form action="{{url('/place-order')}}" method="POST">

                        {{ csrf_field() }}


                        <!-- user info -->
                        <div class="row">

                            <div class="col-6">
                                <div class="form-group focused">
                                    <label class="form-control-label">First Name</label>
                                    <input type="text" id="fname" name="fname" class="form-control form-control-alternative" placeholder="First Name"  value="{{ Auth::user()->name}}" spellcheck="false">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-control-label">Last Name</label>
                                    <input type="text" id="Iname" name="Iname" class="form-control form-control-alternative" placeholder="Last Name" value="{{ Auth::user()->lname}}" spellcheck="false">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-control-label">Email</label>
                                    <input type="email" id="email" name="email" class="form-control form-control-alternative bg-white" readonly placeholder="Email Address" value="{{ Auth::user()->email}}" spellcheck="false">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group focused">
                                    <label class="form-control-label">Phone Number</label>
                                    <input type="number" id="phone" name="phone" class="form-control form-control-alternative" placeholder="Phone Number" value="{{ Auth::user()->phone}}" spellcheck="false">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-control-label">Alternate Phone Number</label>
                                    <input type="number" id="alternate_phone" name="alternate_phone" class="form-control form-control-alternative" placeholder="Alternate Phone Number" value="{{ Auth::user()->alternate_phone}}" spellcheck="false">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group focused">
                                    <label class="form-control-label">Address 1 (Flat No, Apt No & Address)</label>
                                    <textarea name="address1" id="address1" rows="4" class="form-control form-control-alternative" placeholder="Address 1 (Optional)" spellcheck="false">{{ Auth::user()->address1}}
                                    </textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group focused">
                                    <label class="form-control-label">Address 2 (Landmark, near by)</label>
                                    <textarea name="address2" id="address2" rows="4" class="form-control form-control-alternative" placeholder="Address 2 (Optional)" spellcheck="false">{{ Auth::user()->address2}}
                                    </textarea>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group focused">
                                    <label class="form-control-label">City</label>
                                    <input type="text" name="city" id="city" class="form-control form-control-alternative" placeholder="City" value="{{ Auth::user()->city}}" spellcheck="false">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group focused">
                                    <label class="form-control-label">State</label>
                                    <input type="text" id="state" name="state" class="form-control form-control-alternative" placeholder="State" value="{{ Auth::user()->state}}" spellcheck="false">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-control-label">Postal code</label>
                                    <input type="number" id="pincode" name="pincode" class="form-control form-control-alternative" placeholder="Postal code" value="{{ Auth::user()->pincode}}" spellcheck="false">
                                </div>
                            </div>

                        </div>

                        <div class="row mt-4">

                            <!-- instruction -->
                            <div class="col-lg-12">

                                <div class="bg-light px-4 py-3 text-uppercase font-weight-bold">Instructions for seller</div>
                                <div class="p-1">
                                    <p class="font-italic mb-4 mt-3 font-weight-bolder">If you have some information for the seller you can leave them in the box below</p>
                                    <div class="form-group focused">
                                        <textarea name=""  rows="4" class="form-control form-control-alternative" placeholder="Leave Here" spellcheck="false"></textarea>
                                    </div>
                                </div>

                            </div>

                            <!-- place order -->
                            <div class="col-lg-12 border-bottom">
                                <button type="submit" name="place_order_btn" class="float-right mb-4 mt-4 ml-0 mr-0 btn btn-upper bg-gradient-primary text-white rounded">
                                    Place Your Order
                                </button>
                            </div>

                            <!-- payments -->
                            <div class="col-lg-12 mt-4">

                                <button type="button" title='Pay Online with Stripe' class="mb-4 btn buttonsubs bg-gradient-warning rounded">
                                    <img width='50px' src="{{ asset('assets/img/stripe.png')}}">
                                </button>

                                <button type="button" title='Pay Online with RazorPay' class="razorpay_pay_btn mb-4 btn blue-gradient rounded">
                                    <img width='100px' src="{{ asset('assets/img/razor.png')}}">
                                </button>


                            </div>

                        </div>

                    </form>

                    @include('frontend.checkout.stripepaymodal')

                </div>

                <!-- cart data -->
                <div class="col-lg-6 px-4">
                    <div class="bg-light px-4 py-3  text-uppercase font-weight-bold">Coupon code</div>
                    <div class="p-1">
                        <p class="font-italic mb-3 mt-3 font-weight-bolder">
                            If you have a coupon code, please enter it in the box below. <br/>
                            <small id="error_coupon" class="text-danger font-weight-bold"></small>
                        </p>
                        <div class="input-group border mb-4 rounded-pill p-1">
                            <input type="text" name="coupon_code" placeholder="Enter coupon code" class="coupon_code form-control border-0 mt-2 ml-1">
                            <div class="input-group-append border-0">
                                <button type="button" class="apply_coupon_btn btn bg-gradient-info px-4 text-white rounded-pill">
                                    <i class="fa fa-gift mr-2"></i>Apply coupon
                                </button>
                            </div>
                        </div>
                    </div>

                    @if(isset($cart_data))

                        @if(Cookie::get('shopping_cart'))
                            @php $total="0"; $itemno = "0"; @endphp

                            <div class="table-responsive-vertical">
                                <table id="table" class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="font-weight-bold text-uppercase border-0 cart-description">Item</th>
                                            <th scope="col" class="font-weight-bold text-uppercase border-0 cart-product-name">Product</th>
                                            <th scope="col" class="font-weight-bold text-uppercase border-0 cart-price">Price</th>
                                            <th scope="col" class="font-weight-bold text-uppercase border-0 cart-qty">Quantity</th>
                                        </tr>
                                    </thead>

                                    <tbody class="my-auto">
                                        @foreach ($cart_data as $data)
                                        @php $itemno = $itemno +1; @endphp
                                        <tr class="cartpage">

                                            <td data-title="Item" class="cart-product-sub-total">
                                                <span class="cart-sub-total-price">{{ $itemno }}</span>
                                            </td>

                                            <td data-title="Product" class="cart-product-name-info">
                                                <h6 class='cart-product-description font-weight-bolder'>
                                                    <a href="javascript:void(0)">
                                                        {{ $data['item_name'] }}
                                                    </a>
                                                </h6>
                                            </td>

                                            <td data-title="Price" class="cart-product-sub-total">
                                                <span class="cart-sub-total-price">$ {{ number_format($data['item_price'], 2) }}</span>
                                            </td>

                                            <td data-title="Quantity" class="cart-product-quantity">
                                                <span class="cart-quantity">{{ $data['item_quantity'] }}</span>
                                            </td>

                                            @php $total = $total + ($data["item_quantity"] * $data["item_price"]) @endphp

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <hr>

                            <div class="text-right">
                                <h5 class="font-weight-bolder">
                                    Sub Total :
                                    <strong class="text-primary">${{ number_format($total, 2) }}</strong>
                                </h5>
                                <h5 class="font-weight-bolder">
                                    Discount :
                                    <strong class="text-primary discount_price">0.00</strong>
                                </h5>
                                <h5 class="font-weight-bolder">
                                    Grand Total :
                                    <strong class="text-primary grandtotal_price">${{ number_format($total, 2) }}</strong>
                                </h5>
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

@section('scripts')

    <!-- Razor pay methods -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="{{ asset('assets/js/checkout.js') }}"></script>

    <!-- Stripe pay methods -->
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script src="{{ asset('assets/js/checkout-stripe.js') }}"></script>
    <script src="{{ asset('assets/js/creditcard.js') }}"></script>

@endsection

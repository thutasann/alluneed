@extends('layouts.frontend')

@section('title')
    Wishlist
@endsection

@section('content')

<div class="px-4 px-lg-0 my-4">
    <div class="pb-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    @if(count($wishlist) > 0)

                        <div class="page-header px-4 mb-2 mt-3">
                            <h4 class="page-title font-weight-bolder">
                                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                                    <i class="fa fa-bar-chart" aria-hidden="true"></i>
                                </span>
                                Your Wishlist
                            </h4>
                        </div>

                        <div class="py-1 p-4 table-responsive-vertical">
                            <table id="table" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" class="font-weight-bold text-uppercase border-0 cart-description">No.</th>
                                        <th scope="col" class="font-weight-bold text-uppercase border-0 cart-description">Image</th>
                                        <th scope="col" class="font-weight-bold text-uppercase border-0 cart-product-name">Product</th>
                                        <th scope="col" class="font-weight-bold text-uppercase border-0 cart-price">Price</th>
                                        <th scope="col" class="font-weight-bold text-uppercase border-0 cart-total">View</th>
                                        <th scope="col" class="font-weight-bold text-uppercase border-0 cart-romove">Remove</th>
                                        <th scope="col" class="font-weight-bold text-uppercase border-0 cart-romove">Saved At</th>
                                    </tr>
                                </thead>

                                @php $itemno = 0; @endphp

                                <tbody class="my-auto">
                                    @foreach($wishlist as $item)
                                        @if (isset($item->products))

                                            @php $itemno = $itemno +1; @endphp

                                            <tr class="wishlist-content">
                                                <input type="hidden" class="wishlist_id" value={{ $item->id }}>

                                                <td data-title="No.">
                                                    <span>{{ $itemno }}</span>
                                                </td>
                                                <td data-title="Image">
                                                    <img src="{{ asset('uploads/products/prod/'.$item->products->prod_image) }}" width="70" class="img-fluid rounded shadow-sm">
                                                </td>
                                                <td data-title="Product">
                                                    <h6>{{ $item->products->name }}</h6>
                                                </td>
                                                <td data-title="Price">
                                                    <span> $ {{ number_format( $item->products->offer_price, 2) }} </span>
                                                </td>
                                                <td data-title="View">
                                                    <a href="{{url('collection/'.$item->products->subcategory->category->group->url.'/'.$item->products->subcategory->category->url.'/'.$item->products->subcategory->url.'/'.$item->products->url.'/'.Crypt::encrypt($item->products->id))}}"
                                                    class="btn btn-primary btn-sm">View</a>
                                                </td>
                                                <td data-title="Remove">
                                                    <button type="button" class="btn btn-danger btn-sm wishlist-remove-btn mt-0 mr-0">Remove</button>
                                                </td>
                                                <td data-title="Saved At">
                                                    <span>{{ date('F j, Y',strtotime($item->created_at)) }}</span>
                                                </td>
                                            </tr>

                                        @endif
                                    @endforeach
                                <tbody>
                            </table>
                        </div>

                    @else

                        <div class="row">
                            <div class="col-md-12 mycard py-3 text-center">
                                <div class="mycards">
                                    <h4 class="font-weight-bolder mb-5 mt-3 empty-header">Your Wishlist is currently empty.</h4>
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

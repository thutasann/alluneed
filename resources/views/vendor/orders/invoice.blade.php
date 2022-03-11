<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png')}}">
    <title>AllUNeed Invoice</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Oswald:wght@200;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap");
        *{
            font-family: 'Roboto', sans-serif;
        }
        body{
            margin: 0;
            padding: 0;
        }
        h1,h2,h3,h4,h5,h6{
            margin: 0;
            padding: 0;
        }
        .mb-1{
            margin-bottom: 1rem;
        }
        .mb-2{
            margin-bottom: 2rem;
        }
        .mb-3{
            margin-bottom: 3rem;
        }
        .mb-4{
            margin-bottom: 4rem;
        }
        p{
            margin: 0;
            padding: 0;
        }
        .text-primary{
            color: #007bff;
            font-weight: 500;
        }
        .heading{
            padding-bottom: 6px;
        }
        .sub-heading{
            padding-bottom: 3px;
        }
        .container{
            width: 80%;
            margin-right: auto;
            margin-left: auto;
            margin-top: 2rem;
            margin-bottom: 2rem;
            border: 1px solid gray;
            border-radius: 5px;
        }
        .brand-section{
            background-color: #007bff;
            padding: 10px 18px;
        }
        .logo{
            width: 50%;
        }
        .row{
            display: flex;
            justify-content: space-between;
        }
        .col-6{
            width: 50%;
            flex: 0 0 auto;
        }
        .text-white{
            color: #fff;
        }
        .company-details{
            float: right;
            text-align: right;
        }
        .body-section{
            padding: 16px;
            border-bottom: 1px solid gray;
            border-top: none;
        }
        .body-section:last-child{
            border-bottom: none;
            background-color: #F6F6F6;
            margin-bottom: 5px;
        }
        .heading{
            font-size: 20px;
            margin-bottom: 08px;
        }
        .sub-heading{
            color: #262626;
            margin-bottom: 05px;
        }
        table{
            background-color: #fff;
            width: 100%;
            border-collapse: collapse;
        }
        table thead tr{
            border: 1px solid #111;
            background-color: #f2f2f2;
        }
        table td {
            vertical-align: middle !important;
            text-align: center;
        }
        table th, table td {
            padding-top: 08px;
            padding-bottom: 08px;
        }
        .table-bordered{
            box-shadow: 0px 0px 5px 0.5px gray;
        }
        .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6;
        }
        .text-right{
            text-align: end;
            padding-right: 5px;
        }
        .w-20{
            width: 20%;
        }
        .float-right{
            float: right;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="brand-section">
            <h1 class="text-white">ALLUNEED Invoice</h1>
        </div>

        <div class="body-section">
            <div class="mb-1">

                <div class="mb-2">
                    <h2 class="heading">Invoice No: {{ $orders->id }}</h2>
                    <p class="sub-heading">Tracking No: <span class="text-primary">#{{ $orders->tracking_no }}</span> </p>
                    <p class="sub-heading">Order Date: {{ $orders->created_at->format('d-m-Y') }} </p>
                    <p class="sub-heading">Order Status:
                        @if ($orders->order_status == '0')
                            Pending
                        @elseif($orders->order_status == '1')
                            Completed
                        @elseif($orders->order_status == '2')
                            Cancelled
                        @endif
                    </p>
                    <p class="sub-heading">Payment Method: <span class="text-primary">{{ $orders->payment_mode }}</span> </p>
                </div>

                <div class="">
                    <h2 class="heading">Customer Info:</h2>
                    <p class="sub-heading">Full Name: {{ $orders->user->name }} </p>

                    @if($orders->user->Iname)
                        <p class="sub-heading">Sur Name: {{ $orders->user->Iname }} </p>
                    @else
                        <p class="sub-heading">Sur Name:</p>
                    @endif

                    <p class="sub-heading">Email: <span class="text-primary">{{ $orders->user->email }}</span> </p>

                    <p class="row">
                        @if($orders->user->city)
                        {{ $orders->user->city }} .
                        @else
                        @endif

                        @if($orders->user->state)
                        {{ $orders->user->state }} .
                        @else
                        @endif

                        @if($orders->user->pincode)
                        {{ $orders->user->pincode }} .
                        @else
                        @endif

                        @if($orders->user->country)
                        {{ $orders->user->country }}
                        @else
                        @endif

                    </p>
                </div>

            </div>
        </div>

        <div class="body-section">
            <h3 class="heading">Ordered Items</h3>
            <br>

            <table class="table-bordered">

                <thead>
                    <tr>
                        <th>Item</th>
                        <th class="w-20">Price</th>
                        <th class="w-20">Quantity</th>
                        <th class="w-20">Grandtotal</th>
                    </tr>
                </thead>

                <tbody>

                    @php
                        $total = "0";
                    @endphp

                    @foreach ($orders->orderitems as $item)

                    <tr>
                        <td>{{ $item->products->name }}</td>
                        <td>$ {{number_format( $item->price,0) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>$ {{ number_format($item->price * $item->quantity,0) }}</td>
                    </tr>

                    @php
                        $total = $total + ($item->price * $item->quantity);
                    @endphp

                    @endforeach

                    <tr>
                        <td colspan="3" class='text-right'>Sub Total</td>
                        <td>$ {{ number_format($total,0) }}</td>
                    </tr>


                    <tr>
                        <td colspan="3" class='text-right'>Tax-Amount</td>
                        <td>
                            {{-- Grand_Total = total_amount * Tax/ 100 --}}
                            @if (isset($item->tax_amt))
                                @php
                                    $tax = $item->tax_amt;
                                    $tax_total = ($total * $tax)/100;
                                @endphp
                                $ {{ number_format($tax_total,0) }}

                            @else
                                0
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3" class='text-right'>Grand Total</td>
                        <td>
                            @if (isset($item->tax_amt))
                                @php
                                    $grandtotal = $tax_total + $total;
                                @endphp
                                $ {{ number_format($grandtotal,0) }}
                            @else
                                $ {{ number_format($total,0) }}
                            @endif
                        </td>
                    </tr>

                </tbody>

            </table>
            <br>

            <h3 class="heading">Sellers you ordered items from</h3>
            @foreach ($orders->orderitems as $item)
                @php
                    $vendor_id = $item->products->user->id;
                    $vendor = App\Models\Models\Request_vendor::where('user_id', $vendor_id)->get();
                @endphp
                @foreach ($vendor as $v)
                    <p class="sub-heading">- {{ $v->vendor_name }}</p>
                @endforeach
            @endforeach
        </div>

        <div class="body-section">
            <p>&copy; Copyright 2021 - ALLUNEED. All rights reserved.
                <a href="https://www.alluneed.com/" class="float-right">www.alluneed.com</a>
            </p>
        </div>
    </div>

</body>
</html>


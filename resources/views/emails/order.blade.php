<html>

<head>
    <style>
        .container{
            font-family: 'Open Sans Condensed', sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table td,
        table th {
            border: 1px solid #ddd;
            padding: 8px;
            width: 30%;
        }

        table th {
            width: 10%;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
        }

        table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #007bff;
            color: white;
        }
        .heading {
            background-color:#efefef;
            padding:5px;
            border-radius:5px;
        }
        .heading h2{
            font-size:1.4rem;
       }
    </style>
</head>
<body>
    <div class="container">
        <div class="heading">
            <h2>AllUNeed: Order Detail</h2>
        </div>
        <h2>Tracking No: {{$order_data['trackingno']}}</h2>
        <h4>First Name: {{ $order_data['first_name'] }}</h4>
        <h4>Last Name: {{ $order_data['last_name'] }}</h4>
        <h4>Phone Number: {{ $order_data['phone_no'] }}</h4>
        <h4>Alternate Phone Number: {{ $order_data['alter_no'] }}</h4>
        <h4>Address 1: {{ $order_data['address1'] }}</h4>
        <h4>Address 2: {{ $order_data['address2'] }}</h4>
        <h4>City: {{ $order_data['city'] }}</h4>
        <h4>State: {{ $order_data['state'] }}</h4>
        <h4>Pincode: {{ $order_data['pincode'] }}</h4>
        <h4>Email: {{ $order_data['email'] }}</h4>


        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Qty</th>
                    <th>Price</th>
                </tr>
            </thead>

            <tbody>
                @php $total="0"; @endphp

                @foreach($items_in_cart as $order_data)

                <tr>
                    <td>{{ $order_data['item_name'] }}</td>
                    <td>{{ $order_data['item_quantity'] }}</td>
                    <td>${{ number_format($order_data['item_price'],2) }}</td>
                </tr>
                @php $total = $total + ($order_data['item_quantity'] * $order_data['item_price']); @endphp

                @endforeach

                <tr>
                    <td colspan="2">Grand Total:</td>
                    <td>$ {{ number_format($total,2) }}</td>
                </tr>

            </tbody>
        </table>
    </div>
</body>

</html>

<html>

<head>
    <style>
        .container{
            font-family: 'Open Sans Condensed', sans-serif;
        }
        .heading {
            background-color:#efefef;
            padding:5px;
            padding-left: 6.7px;
            border-radius:5px;
        }
        .heading h2{
            font-size:1.25rem;
        }
        .footer{
            background-color:#efefef;
            padding: 6px;
            height:5.6vh;

        }
        .footer .div1{
            float: left;
        }
        .footer .div2{
            float:right;
        }
        @media (max-width: 768px) {
            .footer{
                height:11.3vh;
            }
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="heading" style="margin-bottom: 1.2rem;">
            <h2>AllUNeed: You Received a coupon Code from our Seller !</h2>
        </div>

        <h4>Seller Name: {{$c_data['vendor_name']}}</h4>
        <h4>Seller Email: {{$c_data['vendor_email']}}</h4>
        <h4>Customer Email: {{$c_data['user_email']}}</h4>

        <hr>

        <h4>Coupon Detail: {{$c_data['offer_name']}}</h4>
        <h4>Coupon Code: <span style="color: #007bff;">{{$c_data['coupon_code']}}</span></h4>
        <h4>Start Date: {{$c_data['start_datetime']}}</h4>
        <h4>End Date: {{$c_data['end_datetime']}}</h4>


        <div class="footer">
            <div class="div1">
                You will get discount amount if you make order with this coupon code.
            </div>
            <div class="div2">
                Sincerely, <br>
                <span style="color: #007bff; font-weight: 600;">AllUNeed Ecommerce</span>
            </div>
        </div>

    </div>
</body>

</html>

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
            height:11.7vh;
          }
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="heading" style="margin-bottom: 1.2rem;">
            <h2>AllUNeed: Your Account is now a Vendor Account in AllUNeed !</h2>
        </div>

        <h4>User Name: {{$v_data['name']}}</h4>
        <h4>Email: {{$v_data['email']}}</h4>
        <h4>Vendor Display Name: {{$v_data['vendor_name']}}</h4>
        <h4>Requested Date : {{$v_data['created_at']}}</h4>
        <h4>Description : {{ $v_data['description']  }}</h4>

        <div class="footer">
            <div class="div1">
                You can now upload items, sell and advertise items in Vendor Dashboard.
            </div>
            <div class="div2">
                Sincerely, <br>
                <span style="color: #007bff; font-weight: 600;">AllUNeed Ecommerce</span>
            </div>
        </div>

    </div>
</body>

</html>

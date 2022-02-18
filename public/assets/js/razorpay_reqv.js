$(document).ready(function(){

    $('.razorpay_pay_btn').click(function(e){

        e.preventDefault();

        var data = {
            // '_token': $('input[name=_token]').val(),
            'name': $('input[name=name]').val(),
            'email': $('input[name=email]').val(),
            'vendor_name': $('input[name=vendor_name]').val(),
            'description': $('textarea[name=description]').val(),
        }


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({

            url: '/check-user',
            method:"POST",
            data: data,

            success: function (response){

                var options =
                {
                    "key": "rzp_test_cJfl80NO7JclK2",
                    "amount": (20 * 100),
                    "name": "AllUNeed",
                    "description": "Updating to Vendor Account",
                    "image": "http://localhost:8000/assets/img/logo.png",

                    "handler": function (razorpay_response){


                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        src = $('#reqv_form').attr('action');


                        $.ajax({

                            url: src,
                            type: "POST",
                            data:{
                                'razorpay_payment_id': razorpay_response.razorpay_payment_id,
                                'vendor_name' : response.vendor_name,
                                'description'  : response.description,
                                'place_order_razorpay' : true,
                            },
                            success:function() {
                                window.location.reload();
                            },

                        });
                    },

                    "prefill":
                    {
                        "name": response.name,
                        "email": response.email
                    },

                    "theme":
                    {
                        "color": "#528FF0"
                    }

                };

                var rzp1 = new Razorpay(options);
                rzp1.open();
                e.preventDefault();

            }

        });



    });

});

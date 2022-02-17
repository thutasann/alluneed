$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.razorpay_pay_btn').click(function(e){

        e.preventDefault();

        var data = {
            '_token': $('input[name=_token]').val(),
            'name': $('input[name=name]').val(),
            'email': $('input[name=email]').val(),
            'vendor_name': $('input[name=vendor_name]').val(),
            'description': $('textarea[name=description]').val(),
        }
        var action = $('#reqv_form').attr('action');


        $.ajax({

            type:"POST",
            url: '/check-user',
            data: data,

            success: function (response){

                var options =
                {
                    "key": "rzp_test_cJfl80NO7JclK2",
                    "amount": (20 * 100),
                    "name": "AllUNeed",
                    "description": "Updating to Vendor Account",
                    "image": "http://localhost:8000/assets/img/logo.png",

                    "handler": function (razorpay_response)
                    {
                        $.ajax({

                            url: action,
                            type: "POST",
                            data:{
                                '_token': $('input[name=_token]').val(),
                                'razorpay_payment_id': razorpay_response.razorpay_payment_id,
                                'name': response.name,
                                'email' : response.email,
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

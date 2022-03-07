$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // apply coupon code
    $('.apply_coupon_btn').click(function(e){
        e.preventDefault();

        var coupon_code = $('.coupon_code').val();

        if ($.trim(coupon_code).length == 0) {
            error_coupon = "Please enter the valid Coupon code"
            $('#error_coupon').text(error_coupon);
        }
        else{
            error_coupon = ""
            $('#error_coupon').text(error_coupon);
        }

        if (error_coupon != '') {
            return false;
        }


        $.ajax({
            method: "POST",
            url:"/check-coupon-code",
            data: {
                'coupon_code' : coupon_code
            },
            success: function (response){
                if (response.error_status == 'error') {
                    alertify.set('notifier','position','top-right');
                    alertify.success(response.status);
                    $('.coupon_code').val('');
                }
                else{
                    var discount_price = response.discount_price;
                    var grand_total_price = response.grand_total_price;
                    $('.coupon_code').val('');

                    $('.coupon_code').prop('readonly', true);
                    $('.coupon_code').css('background-color', 'white');
                    $('.discount_price').text(discount_price);
                    $('.grandtotal_price').text(grand_total_price);

                }
            }
        });
    });

    $('.razorpay_pay_btn').click(function(e){
        e.preventDefault();

        var data = {

            '_token': $('input[name=_token]').val(),
            'first_name': $('input[name=fname]').val(),
            'last_name': $('input[name=Iname]').val(),
            'email': $('input[name=email]').val(),
            'phone_no': $('input[name=phone]').val(),
            'alter_no': $('input[name=alternate_phone]').val(),
            'address1': $('textarea[name=address1]').val(),
            'address2': $('textarea[name=address2]').val(),
            'city': $('input[name=city]').val(),
            'state': $('input[name=state]').val(),
            'pincode': $('input[name=pincode]').val()
        }


        $.ajax({

            type:"POST",
            url: '/confirm-razorpay-payment',
            data: data,

            success: function (response){

                if(response.status_code == 'no_data_in_Cart')
                {
                    window.location.href = '/cart';
                }
                else
                {
                    // console.log(response.total_price);
                    // 8880202617@ybl

                    var options =
                    {
                        "key": "rzp_test_cJfl80NO7JclK2",
                        "amount": (response.total_price * 100),
                        "name": "AllYouNeed",
                        "description": "Thank For your Purchasing",
                        "image": "http://localhost:8000/assets/img/Ulogo.png",


                        "handler": function (razorpay_response)
                        {
                            $.ajax({

                                url: "/place-order",
                                type: "POST",
                                data:{

                                    '_token': $('input[name=_token]').val(),
                                    'razorpay_payment_id': razorpay_response.razorpay_payment_id,
                                    'fname': response.first_name,
                                    'Iname': response.last_name,
                                    'email' : response.email,
                                    'phone': response.phone_no,
                                    'alternate_phone': response.alter_no,
                                    'address1': response.address1,
                                    'address2': response.address2,
                                    'city': response.city,
                                    'state': response.state,
                                    'pincode': response.pincode,
                                    'place_order_razorpay' : true,
                                },


                                success:function() {
                                    window.location.href = '/thank-you';
                                },

                            });
                        },

                        "prefill":
                        {
                            "name": response.first_name + response.last_name,
                            "contact": response.phone_no,
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
            }

        });

    });

});

// profile update ajax
$(document).ready(function(){

$('#pro_update_form').on('submit', function(event){

    event.preventDefault();
    var count_error = 0;

    var action = $(this).attr('action');
    var fname = $(this).closest('.profile-update').find('#fname').val();
    var lname = $(this).closest('.profile-update').find('#lname').val();

    var user_id = $(this).closest('.profile-update').find('#user_id').val();
    var vendor_name = $(this).closest('.profile-update').find('#vendor_name').val();
    var description = $(this).closest('.profile-update').find('#description').val();

    var address1 = $(this).closest('.profile-update').find('#address1').val();
    var address2 = $(this).closest('.profile-update').find('#address2').val();
    var country = $(this).closest('.profile-update').find('#form-autocomplete-country').val();
    var city = $(this).closest('.profile-update').find('#city').val();
    var state = $(this).closest('.profile-update').find('#state').val();
    var pincode = $(this).closest('.profile-update').find('#pincode').val();
    var phone = $(this).closest('.profile-update').find('#phone').val();
    var alternate_phone = $(this).closest('.profile-update').find('#alternate_phone').val();

    // if($(this).closest('.profile-update').find('#customSwitches').prop("checked")==true)
    // {
    //     var roles = true;
    // }
    // else
    // {
    //     var roles = '';
    // }

    if(count_error == 0)
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({

            url: action,
            method:"POST",
            data:{
                'fname': fname,
                'lname': lname,
                'user_id' : user_id,
                'vendor_name' : vendor_name,
                'description' : description,
                'address1': address1,
                'address2': address2,
                'country': country,
                'city': city,
                'state': state,
                'pincode': pincode,
                'phone': phone,
                'alternate_phone': alternate_phone,
            },

            beforeSend:function()
            {
                $('#save').attr('disabled', 'disabled');
                $('#reset').attr('disabled', 'disabled');
                $('#process_profile').css('display', 'block');

                $('#fname').attr('readonly', 'readonly');
                $('#fname').css('background-color', 'white');

                $('#Iname').attr('readonly', 'readonly');
                $('#Iname').css('background-color', 'white');

                $('#address1').attr('readonly', 'readonly');
                $('#address1').css('background-color', 'white');

                $('#address2').attr('readonly', 'readonly');
                $('#address2').css('background-color', 'white');

                $('#form-autocomplete-country').attr('readonly', 'readonly');
                $('#form-autocomplete-country').css('background-color', 'white');

                $('#city').attr('readonly', 'readonly');
                $('#city').css('background-color', 'white');

                $('#state').attr('readonly', 'readonly');
                $('#state').css('background-color', 'white');

                $('#pincode').attr('readonly', 'readonly');
                $('#pincode').css('background-color', 'white');

                $('#phone').attr('readonly', 'readonly');
                $('#phone').css('background-color', 'white');

                $('#alternate_phone').attr('readonly', 'readonly');
                $('#alternate_phone').css('background-color', 'white');

            },

            success:function(data) {

                var percentage = 0;
                var timer = setInterval(function(){
                percentage = percentage + 20;
                progress_bar_process(percentage, timer);
                }, 1000);

                $('.title').html('AllUNeed | ' + fname);
                $('#pro-name').load(location.href + ' .pro-name');
                $('#country').load(location.href + ' .country');
                $('#address1').load(location.href + ' .address1');
                $('#v_desc').load(location.href + ' .v_desc');
                $('#v_name').load(location.href + ' .v_name');

                // if(roles == true)
                // {
                //     $('.roles').html('(' + 'Vendor' + ')' );
                //     $('.go-vendor').css('display','block');
                //     $('.custom-control-label').html('Switch to Customer Account');
                // }
                // else
                // {
                //     $('.roles').html('');
                //     $('.go-vendor').css('display','none');
                //     $('.custom-control-label').html('Switch to Vendor Account');
                // }
            },

        });
    }
    else
    {
    return false;
    }

});

// progress bar
function progress_bar_process(percentage, timer)
{
    $('.progress-bar').css('width', percentage + '%');

    if(percentage > 100)
    {
        clearInterval(timer);
        $('#process_profile').css('display', 'none');
        $('.progress-bar').css('width', '0%');
        $('#save').attr('disabled', false);
        $('#reset').attr('disabled', false);
        $('#success_message_profile').html("<div class='alert alert-success'>Your Profile was Updated !</div>");

        $('#fname').attr('readonly', false);
        $('#Iname').attr('readonly', false);
        $('#address1').attr('readonly', false);
        $('#address2').attr('readonly', false);
        $('#form-autocomplete-country').attr('readonly', false);
        $('#city').attr('readonly', false);
        $('#state').attr('readonly', false);
        $('#pincode').attr('readonly', false);
        $('#phone').attr('readonly', false);
        $('#alternate_phone').attr('readonly', false);

        setTimeout(function()
        {
        $('#success_message_profile').html('');
        }, 5000);
    }


}

});


              // profile update ajax
              $(document).ready(function(){
                      
                $('#pro_update_form').on('submit', function(event){
                  
                    event.preventDefault();
                    var count_error = 0;

                    var fname = $(this).closest('.profile-update').find('#fname').val();
                    var Iname = $(this).closest('.profile-update').find('#Iname').val();
                    var address1 = $(this).closest('.profile-update').find('#address1').val();
                    var address2 = $(this).closest('.profile-update').find('#address2').val();
                    var country = $(this).closest('.profile-update').find('#form-autocomplete-country').val();
                    var city = $(this).closest('.profile-update').find('#city').val();
                    var state = $(this).closest('.profile-update').find('#state').val();
                    var pincode = $(this).closest('.profile-update').find('#pincode').val();
                    var phone = $(this).closest('.profile-update').find('#phone').val();
                    var alternate_phone = $(this).closest('.profile-update').find('#alternate_phone').val();
                    
                    if($(this).closest('.profile-update').find('#customSwitches').prop("checked")==true)
                    {
                        var roles = true;
                    }
                    else
                    {
                        var roles = ''; 
                    }

                
                    if(count_error == 0)
                    {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({

                            url:"/my-profile-update",
                            method:"POST",
                            data:{
                                'fname': fname,
                                'Iname': Iname,
                                'address1': address1,
                                'address2': address2,
                                'country': country,
                                'city': city,
                                'state': state,
                                'pincode': pincode,
                                'phone': phone,
                                'alternate_phone': alternate_phone,
                                'roles': roles,
                            },

                            beforeSend:function()
                            {
                              $('#save').attr('disabled', 'disabled');
                              $('#process_profile').css('display', 'block');
                            },

                            success:function(data) {

                                var percentage = 0;
                                var timer = setInterval(function(){
                                percentage = percentage + 20;
                                progress_bar_process(percentage, timer);
                                }, 1000);

                                $('.title').html(fname + ' | Fabcart');
                                $('#pro-name').load(location.href + ' .pro-name');
                                $('#country').load(location.href + ' .country');
                                $('#address1').load(location.href + ' .address1');

                                if(roles == true)
                                {
                                    $('.roles').html('(' + 'Vendor' + ')' );
                                    $('.go-vendor').css('display','block');
                                    $('.custom-control-label').html('Switch to Customer Account');
                                }
                                else
                                {
                                    $('.roles').html('');
                                    $('.go-vendor').css('display','none');
                                    $('.custom-control-label').html('Switch to Vendor Account');
                                }
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
                        $('#success_message_profile').html("<div class='alert alert-success'>Profile Updated !</div>");

                        setTimeout(function()
                        {
                        $('#success_message_profile').html('');
                        }, 3000);

                    }

                    
                }

             });


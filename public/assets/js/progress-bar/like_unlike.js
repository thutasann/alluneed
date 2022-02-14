$(document).ready(function(){

    // when the user clicks on like
    $('.like').on('click', function()
    {
        var user_id = $(this).closest('.love-form').find('#user_id').val();
        var prod_id = $(this).closest('.love-form').find('#prod_id').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url:"/store-like",
            method:"POST",
            data: {
                'user_id': user_id,
                'prod_id': prod_id,
            },

            success: function(data){
                $('#like_unlike').load(location.href + ' .like_unlike');

            }
        });
    });

    // when the user clicks on unlike
    $('.unlike').on('click', function()
    {
            var user_id = $(this).closest('.love-form').find('#user_id').val();
            var prod_id = $(this).closest('.love-form').find('#prod_id').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url:"/store-unlike",
                method:"POST",
                data: {
                    'user_id': user_id,
                    'prod_id': prod_id,
                },

                success: function(data){
                    $('#like_unlike').load(location.href + ' .like_unlike');

                }
            });
    });

});



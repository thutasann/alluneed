$(function() {
    var $form = $(".require-validation");

    $('form.require-validation').bind('submit', function(e) {
        var $form = $(".require-validation"),
            inputSelector = ['input[type=email]',
                            'input[type=password]',
                            'input[type=text]',
                            'input[type=file]',
                            'textarea'].join(', '),
            $inputs       = $form.find('.required').find(inputSelector),
            $errorMessage = $form.find('.inp-error'),
            valid         = true;
            $errorMessage.addClass('d-none');
        $('.has-error').removeClass('has-error');

        $inputs.each(function(i, el) {
            var $input = $(el);
            if ($input.val() === '') {
                $input.parent().addClass('has-error');
                $errorMessage.removeClass('d-none');
                e.preventDefault();
            }
        });

        if (!$form.data('cc-on-file')) {

            // var StripeKey = "pk_test_51I0h7qCb7kjLKG1BqSugQEBTj0ZFLYPFmuZXberovymtH9TV3bQHoM0qTNX5LSGFXNMUtP66O0NhPX8uM8I1TiYS00B6T3YRjB";
            var StripeKey = "pk_test_51I9OesBKw5M31KCuhImzqwggXWR0LJ3xf0ISw6aUXziPhj3d0sEBbzAm1N00Xl5bjnTHG9aNuOjkUjQSZH2Oo7yi00Sw6W45Ye";

            e.preventDefault();
            Stripe.setPublishableKey(StripeKey);
            Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val()
            }, stripeResponseHandler);
        }

    });

    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.stripe-error').text(response.error.message);
        } else {
            var token = response['id'];
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }

});

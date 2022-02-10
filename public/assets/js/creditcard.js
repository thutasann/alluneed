var cc_width = $('div.cc').width();
$('div.cc, .surface, .input_wrapper').css({ 'height': cc_width * 0.7 + 'px' });

// project value in input to credit card
$('input').keyup(function () {
    var nameValue = $(this).attr('name');
    var infoText = $(this).val();
    $('div.' + nameValue + '').html(infoText);
});


$('input[name=digits]').keyup(function () {
    var foo = $(this).val().split(" ").join(""); // remove space
    if (foo.length > 0) {
        foo = foo.match(new RegExp('.{1,4}', 'g')).join(" ");
    }
    $(this).val(foo);
});

// show cc type when punching cc number
$('input[name=digits]').keyup(function () {
    var input_digit = $(this).val();
    var first_digit = input_digit.match(new RegExp('.{1,1}', 'g'))[0];
    var first_two_digit = input_digit.match(new RegExp('.{1,2}', 'g'))[0];
    var first_four_digit = input_digit.match(new RegExp('.{1,4}', 'g'))[0];

    if (first_digit === '4') {
        $('img#visa').css('opacity', '1');
        $('.method:not(#visa)').css('opacity', '0');

    } else if (first_two_digit === '34' || first_two_digit === '37') {
        $('img#ae').css('opacity', '1');
        $('.method:not(#ae)').css('opacity', '0');

    } else if (first_two_digit === '51' || first_two_digit === '52' || first_two_digit === '53' || first_two_digit === '54' || first_two_digit === '55') {
        $('img#master').css('opacity', '1');
        $('.method:not(#master)').css('opacity', '0');

    } else if (first_four_digit === '6011') {
        $('img#disc').css('opacity', '1');
        $('.method:not(#disc)').css('opacity', '0');

    } else {
        $('div.input_wrapper .method').css('opacity', '0');
    }
});


$('input[name=expire_month]').keyup(function(){
  var infoTyped = $(this).val().split("/").join("");
  if(infoTyped.length > 0){
    infoTyped = infoTyped.match(new RegExp('.{1,2}','g')).join("/");
  }
  $(this).val(infoTyped);
});


//constructor function for spinning the credit card
function spinThatCC(element, action) {
    $(element).on(action, function () {
        if ($("input[name=security]").is(":focus")) {
            $('div.cc').css({ 'transform': 'rotateY(180deg)' });

            setTimeout(function () {
                $('div.front').css({ 'z-index': '99' });
                $('div.back').css({ 'z-index': '100' });
            }, 250);

        } else {
            $('div.cc').css({ 'transform': 'rotateY(0deg)' });

            setTimeout(function () {
                $('div.front').css({ 'z-index': '100' });
                $('div.back').css({ 'z-index': '99' });
            }, 250);

        }
    });
}


spinThatCC('body', 'click');
spinThatCC('input', 'keyup');

// modal
$('.buttonsubs').click(function(){
    $('.pop-up').addClass('open');
});

$('.pop-up .close').click(function(){
    $('.pop-up').removeClass('open');
});


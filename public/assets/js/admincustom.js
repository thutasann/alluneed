/*Preloader*/
$(window).load(function () {
    setTimeout(function () {
        $('body').addClass('loaded');
    }, 200);
});

// custom modal
$('.buttonsubs').click(function () {
    $('.pop-up').addClass('open');
});

$('.pop-up .close').click(function () {
    $('.pop-up').removeClass('open');
});

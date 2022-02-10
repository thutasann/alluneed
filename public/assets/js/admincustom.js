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

// Down to Top button
var mybutton = document.getElementById("downToTop");
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  }
  else {
    mybutton.style.display = "none";
  }
}
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}



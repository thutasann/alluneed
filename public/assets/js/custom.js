// wishlist
$(document).ready(function (){

    $('.wishlist-remove-btn').click(function(e){

        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var Clickedthis = $(this);
        var wishlist_id = $(Clickedthis).closest('.wishlist-content').find('.wishlist_id').val();
        // alert(wishlist_id);

        $.ajax({
            type: "POST",
            url: "/remove-from-wishlist",
            data:{
                'wishlist_id': wishlist_id,
            },
            success: function(response) {

                $(Clickedthis).closest('.wishlist-content').remove();
                alertify.set('notifier','position','top-right');
                alertify.success(response.status);
            }
        });


    });

    $('.add-to-wishlist-btn').click(function(e){

        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var product_id = $(this).closest('.product_data').find('.product_id').val();
        // alert(product_id);

        $.ajax({
            type: "POST",
            url: "/add-wishlist",
            data: {
                'product_id': product_id,
            },
            success: function(response){
                alertify.set('notifier','position','top-right');
                alertify.success(response.status);
            }
        });

    });

});

// cart load
$(document).ready(function () {
    cartload();
});

// cart load(count items)
function cartload()
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: '/load-cart-data',
        method: "GET",
        success: function (response) {
            $('.basket-item-count').html('');
            var parsed = jQuery.parseJSON(response)
            var value = parsed; //Single Data Viewing
            $('.basket-item-count').append($('<span class="badge badge-pill red">'+ value['totalcart'] +'</span>'));
        }
    });
}

// add to cart
$(document).ready(function () {
    $('.add-to-cart-btn').click(function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var product_id = $(this).closest('.product_data').find('.product_id').val();
        var quantity = $(this).closest('.product_data').find('.qty-input').val();
        // alert(product_id);

        $.ajax({
            url: "/add-to-cart",
            method: "POST",
            data: {
                'quantity': quantity,
                'product_id': product_id,
            },
            success: function (response) {
                alertify.set('notifier','position','top-right');
                alertify.success(response.status);
                cartload();
            },
        });
    });
});

// Update Cart Data
$(document).ready(function () {

    $('.changeQuantity').click(function (e) {
        e.preventDefault();

        var thisClick = $(this);
        var quantity = $(this).closest(".cartpage").find('.qty-input').val();
        var product_id = $(this).closest(".cartpage").find('.product_id').val();

        var data = {
            '_token': $('input[name=_token]').val(),
            'quantity':quantity,
            'product_id':product_id,
        };

        $.ajax({
            url: '/update-to-cart',
            type: 'POST',
            data: data,
            success: function (response) {
                // window.location.reload();
                console.log(response.gtprice);
                thisClick.closest(".cartpage").find('.cart-grand-total-price').text(response.gtprice);
                $('#totalajaxcall').load(location.href + ' .totalpricingload');
                alertify.set('notifier','position','top-right');
                alertify.success(response.status);
            }
        });
    });

});

// Delete Cart Data
$(document).ready(function () {

    $('.delete_cart_data').click(function (e) {
        e.preventDefault();
        
        var thisDeletearea = $(this);
        var product_id = $(this).closest(".cartpage").find('.product_id').val();

        var data = {
            '_token': $('input[name=_token]').val(),
            "product_id": product_id,
        };

        // $(this).closest(".cartpage").remove();

        $.ajax({
            url: '/delete-from-cart',
            type: 'DELETE',
            data: data,
            success: function (response) {
                // window.location.reload();
                thisDeletearea.closest(".cartpage").remove();
                $('#totalajaxcall').load(location.href + ' .totalpricingload');
                alertify.set('notifier','position','top-right');
                alertify.success(response.status);
            }
        });
    });

});

// Clear Cart Data
$(document).ready(function () {

    $('.clear_cart').click(function (e) {
        e.preventDefault();

        $.ajax({
            url: '/clear-cart',
            type: 'GET',
            success: function (response) {
                window.location.reload();
                alertify.set('notifier','position','top-right');
                alertify.success(response.status);
            }
        });

    });

});



// svg-up smooth scroll
const svgUp = document.querySelector(".copyright .arrow-up");
svgUp.addEventListener("click", () => {
    window.scroll({
        top: 0,
        behavior: "smooth"
    });
});

// Mega Menu Search filter (collection)
function colFunction() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput_col");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL_col");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}

// Mega Menu Search filter (category)
function cateFunction() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput_cate");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL_cate");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}

// Mega Menu Search filter (brand)
function brdFunction() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput_brd");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL_brd");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}

// Home Search filter (collection)
function hcolFunction() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput_hcol");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL_hcol");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}

// Home Search filter (categories)
function hcateFunction() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput_hcate");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL_hcate");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}


// infinite carousel
$('.toggle-all').on('click', function () {
    $('#infinite_carousel .row').toggleClass('flex-nowrap');
    $('#infinite_carousel .control').toggleClass('d-none');
    $(this).html($('#infinite_carousel .row').hasClass('flex-nowrap') ? '<i class="fa fa-th" aria-hidden="true"></i> Show List' : '<i class="fa fa-chevron-right" aria-hidden="true"></i> Show Slider');
});

$('#infinite_carousel .fa-chevron-right').on('click', () => {
    let $infinite_carousel_row = $('#infinite_carousel .row');
    let $col = $infinite_carousel_row.find('.col-6:first');
    $infinite_carousel_row.append($col[0].outerHTML);
    $col.remove();
});

$('#infinite_carousel .fa-chevron-left').on('click', () => {
    let $infinite_carousel_row = $('#infinite_carousel .row');
    let $col = $infinite_carousel_row.find('.col-6:last');
    $infinite_carousel_row.prepend($col[0].outerHTML);
    $col.remove();
});

/*Preloader*/
$(window).load(function() {
    setTimeout(function() {
        $('body').addClass('loaded');
    }, 200);
});












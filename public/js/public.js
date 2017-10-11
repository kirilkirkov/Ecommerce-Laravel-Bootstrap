$(document).ready(function () {
    checkScroll();
    $(window).scroll(checkScroll);
});
$('.fast-order').toggle("slide", {direction: "right"}, 1000);
$('.fast-order .submit').click(function () {
    $('.fast-order .error').hide();
    var phone = $('#phone-user');
    var names = $('#names-user');
    var errors = false;
    if (!$.trim(phone.val())) {
        phone.next('.error').show();
        errors = true;
    }
    if (!$.trim(names.val())) {
        names.next('.error').show();
        errors = true;
    }
    if (errors == false) {
        document.getElementById("go-fast-order").submit();
    }
});
$('.fast-order .close').click(function () {
    if (xsMode()) {
        $('.fast-order-btn').show().addClass('visible-xs');
    }
    $('.fast-order').fadeOut('slow');
});
$('.show-right-menu').click(function () {
    $('.right-menu').toggle("slide", {direction: "left"}, 500);
    $('.backdrop').show();
});
$('.close-xs-menu').click(function () {
    $('.right-menu').toggle("slide", {direction: "left"}, 500);
    $('.backdrop').hide();
});
$('.fast-order-btn').click(function () {
    $('.fast-order').removeClass('hidden-xs');
    $('.fast-order').show();
    $(this).hide().removeClass('visible-xs');
});
/*
 * Add product to cart
 */
$('.buy-now.to-cart').click(function () {
    $('#modalBuyBtn').modal('show');
    var product_id = $(this).data('product-id');
    addProduct(product_id);
    renderCartProducts();
});
/*
 * Show cart products in fast view
 */
$('.cart-button').hover(function () {
    $('.cart-products-fast-view').fadeIn(200);
});
/*
 * change radio button selection for 
 * checkout payment type
 */
$('.box-type').click(function () {
    var radio_val = $(this).data('radio-val');
    $('input:radio[name="payment_type"][value="' + radio_val + '"]').prop('checked', true);
    $(this).addClass('active');
});
/*
 * Hide cart products in fast view
 */
function closeFastCartView() {
    $('.cart-products-fast-view').fadeOut(200);
}
function checkScroll() {
    if ($(this).scrollTop() > 80) {
        if (xsMode() === false) {
            $('.header .navbar-custom').addClass('navbar-fixed-top').removeClass('trans-hide');
            var menuHeight = $('.navbar-custom').height();
            $('.top-part').css('margin-bottom', menuHeight);
        }
    } else {
        $('.header .navbar-custom').removeClass('navbar-fixed-top').addClass('trans-hide');
        $('.top-part').css('margin-bottom', '0');
    }
}
/*
 * Must return true if we are on xs mode
 * Must return false if we are not in xs mode
 */
function xsMode() {
    if ($('.navbar-brand').is(":visible") === false) {
        return false;
    } else {
        return true;
    }
}
/*
 * Add product with ajax to cart
 */
function addProduct(id) {
    var quantity = 1;
    var el_qa = $('[name="quantity"]');
    if (el_qa.length) {
        quantity = el_qa.val();
    }
    $.ajax({
        type: 'POST',
        url: urls.addProduct,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        data: {id: id, quantity: quantity}
    }).done(function (data) {

    });
}
/*
 * Render cart products
 */
function renderCartProducts() {
    $('.cart-fast-view-container').empty();
    $.ajax({
        type: 'POST',
        url: urls.getProducts,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }).done(function (data) {
        var obj = JSON.parse(data);
        $('.cart-fast-view-container').append(obj.html);
        $('.header .user .badge').empty().append(obj.num_products);
    });
}
/*
 * Remove product quantity from cart
 */
function removeQuantity(id) {
    $.ajax({
        type: 'POST',
        url: urls.removeProductQuantity,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {id: id}
    }).done(function (data) {
        renderCartProducts();
    });

}
/*
 * Complete order from checkout page - submit btn
 */
function completeOrder() {
    $('#errors').empty().hide();
    var errors = [];
    var phone = $('[name="phone"]').val();
    var address = $('[name="address"]').val();
    if ($.trim(phone).length <= 0) {
        errors[0] = variables.phoneReq;
    }
    if ($.trim(address).length <= 0) {
        errors[1] = variables.addressReq;
    }
    if (errors.length > 0) {

        $.each(errors, function (index, value) {
            if (typeof value !== "undefined") {
                $('#errors').append(value + '<br>');
            }
        });
        $('#errors').fadeIn(200);
        $('html, body').animate({
            scrollTop: $("#errors").offset().top - 100
        }, 500);
    } else {
        document.getElementById('set-order').submit();
    }
}
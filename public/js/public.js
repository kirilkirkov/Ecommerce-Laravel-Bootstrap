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
    $('.right-menu').toggle("slide", {direction: "left"}, 1000);
    $('.backdrop').show();
});
$('.close-xs-menu').click(function () {
    $('.right-menu').toggle("slide", {direction: "left"}, 1000);
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
$('.buy-now').click(function () {
    $('#modalBuyBtn').modal('show');
});
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
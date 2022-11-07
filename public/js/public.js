var csrf = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function () {
    checkScroll();
    $(window).scroll(checkScroll);
    /*
     * Check for active categories
     */
    var objCategories = $('.products-page .categories ul.children li');
    if (objCategories.length > 0) {
        objCategories.each(function () {
            if ($(this).hasClass('active')) {
                $(this).parents('ul').show();
                $(this).parent('ul').prev('span').find('.fa-minus').show();
                $(this).parent('ul').prev('span').find('.fa-plus').hide();
            } else {
                $(this).parent('ul').prev('span').find('.fa-minus').hide();
                $(this).parent('ul').prev('span').find('.fa-plus').show();
            }
        });
    }
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
});
/*
 * Show cart products in fast view
 */
$('.cart-button').on('click mouseover', function () {
    $('.cart-products-fast-view').fadeIn(200);
});
/*
 * If mouse leave, hide products fast view
 */
$('.cart-fast-view-container').on('mouseleave', function () {
    $('.cart-products-fast-view').fadeOut(200);
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
 * Show/Hide sub categories when click - or +
 */
$('.products-page .categories ul li span').click(function () {
    var span = $(this);
    span.next('.children').slideToggle('fast', function () {
        if ($(this).is(':visible')) {
            span.find('.fa-minus').show();
            span.find('.fa-plus').hide();
        } else {
            span.find('.fa-minus').hide();
            span.find('.fa-plus').show();
        }
    });

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
            'X-CSRF-TOKEN': csrf
        },

        data: {id: id, quantity: quantity}
    }).done(function (data) {
        renderCartProducts();
        renderCheckoutCartProducts();
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
            'X-CSRF-TOKEN': csrf
        }
    }).done(function (data) {
        var obj = JSON.parse(data);
        $('.cart-fast-view-container').append(obj.html);
        $('header .user .badge').empty().append(obj.num_products);
    });
}
/*
 * Render products for checkout page
 */
function renderCheckoutCartProducts() {
    var products_container = $('.products-for-checkout');
    var current_height = products_container.height();
    if (products_container.length) {
        products_container.height(current_height);
        products_container.empty();
        // check only if we are in that page :)
        $.ajax({
            type: 'POST',
            url: urls.getProductsForCheckoutPage,
            headers: {
                'X-CSRF-TOKEN': csrf
            }
        }).done(function (data) {
            products_container.empty().append(data).height('auto');
        });
    }
}
/*
 * Remove product quantity from cart
 */
function removeQuantity(id) {
    $.ajax({
        type: 'POST',
        url: urls.removeProductQuantity,
        headers: {
            'X-CSRF-TOKEN': csrf
        },
        data: {id: id}
    }).done(function (data) {
        renderCartProducts();
        renderCheckoutCartProducts();
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
    if ($('[name="id[]"]').length <= 0) {
        errors[2] = variables.productsReq;
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
/*
 * Remove product from cart
 */
function removeProduct(id) {
    $.ajax({
        type: 'POST',
        url: urls.removeProduct,
        headers: {
            'X-CSRF-TOKEN': csrf
        },
        data: {id: id}
    }).done(function (data) {
        renderCartProducts();
        renderCheckoutCartProducts();
    });
}

/*
 * If we are on product preview page
 * Carusel for images
 */
if ($('.product-preview').length > 0) {
    $("#inner-slider").on('slide.bs.carousel', function (evt) {
        var thisSlideI = $(this).find('.active').index();
        var nextSlideI = $(evt.relatedTarget).index();
        $('[data-slide-to="' + thisSlideI + '"]').removeClass('active');
        $('[data-slide-to="' + nextSlideI + '"]').addClass('active');
    });
}
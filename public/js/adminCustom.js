$(document).ready(function () {
    // lets give 'active' class to choosed link from nav
    $(".left-side ul.nav li").each(function (index) {
        var currentUrl = window.location.href;
        var urlOfLink = $(this).find('a').attr('href');
        currentUrl = currentUrl.split('?')[0];//remove if contains GET
        if (currentUrl == urlOfLink) {
            $(this).addClass('active');
        }
    });
    $('.locale-change').click(function () {
        var toLocale = $(this).data('locale-change');
        $('.locale-container').hide();
        $('.locale-container-' + toLocale).show();
        $('.locale-change').removeClass('active');
        $(this).addClass('active');
    });
});
function removeGalleryImage(image, imgNum) {
    $.ajax({
        type: "POST",
        url: urls.removeGalleryImage,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {image: image}
    }).done(function (data) {
        if (data == '1') {
            $('#image-container-' + imgNum).remove();
        }
    });
}
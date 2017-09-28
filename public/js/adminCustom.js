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
$('.confirm').click(function (e) {
    e.preventDefault();
    var lHref = $(this).attr('href');
    var myMessage = $(this).data('my-message')
    bootbox.confirm({
        message: myMessage,
        buttons: {
            confirm: {
                label: '<i class="fa fa-check" aria-hidden="true"></i>',
                className: 'btn-success'
            },
            cancel: {
                label: '<i class="fa fa-times" aria-hidden="true"></i>',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if (result) {
                window.location.href = lHref;
            }
        }
    });
});
$("#checkAll").click(function () {
    $('input:checkbox').not(this).prop('checked', this.checked);
});
$('.menu-btn-xs').click(function () {
    $('.left-side').slideToggle("slow", function () {

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
function editSelectedCategory() {
    var selected = $('[name="category_id[]"]:checked');
    if (selected.length == 0) {
        showAlert('danger', langs.selectOnlyOneCateg);
    }
    if (selected.length > 1) {
        showAlert('danger', langs.selectJustOneCateg);
    }
    if (selected.length == 1) {
        location.href = urls.editCategory + '?edit=' + selected.val();
    }
}
function showAlert(type, message) {
    $('#temporary-alert').remove();
    if (type == 'danger') {
        type = 'alert-danger';
    }
    if (type == 'success') {
        type = 'alert-success';
    }
    var obj = $('body').prepend('<div class="alert ' + type + ' alert-top" id="temporary-alert">' + message + '</div>');
    $('#temporary-alert').delay(3000).queue(function () {
        $(this).remove();
    });
}
function deleteSelectedCategory() {
    var selected = $('[name="category_id[]"]:checked');
    if (selected.length == 0) {
        showAlert('danger', langs.selectOnlyOneCateg);
    } else {
        bootbox.confirm({
            message: langs.confirmDeleteCategories,
            buttons: {
                confirm: {
                    label: '<i class="fa fa-check" aria-hidden="true"></i>',
                    className: 'btn-success'
                },
                cancel: {
                    label: '<i class="fa fa-times" aria-hidden="true"></i>',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                if (result) {
                    var searchIDs = selected.map(function () {
                        return $(this).val();
                    }).get();
                    window.location.href = urls.deleteCategories + '?ids=' + searchIDs;
                }
            }
        });
    }
}
function updateUser() {
    var val = $('#defaultForm-email').val();
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (val.length == 0 || re.test(val) === false) {
        $('#modalAddEditUsers').modal('toggle');
        showAlert('danger', langs.encorrectemailAddr);
    } else {
        document.getElementById("formManageUsers").submit();
    }
}
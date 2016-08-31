function addPage() {
    $.ajax({
        url: $('#base_url').text() + "/index.php/config/addPage",
        data: {pageIndex: $('.page').last().data("page-index") + 1},
        type: "post",
        success: function (data) {
            $('.pages').append(data);
        }
    });
}
function addObject(el) {
    var pageIndex = $(el).data("page-index");
    $.ajax({
        url: $('#base_url').text() + "/index.php/config/addObject",
        type: "post",
        success: function (data) {
            $('#collapse-page' + pageIndex).append(data);
        }
    });
}
function addAttribute(el) {
    var attributeTable = $(el).parent().parent().parent().next().find('tbody');
    $.ajax({
        url: $('#base_url').text() + "/index.php/config/addAttribute",
        type: "post",
        success: function (data) {
            attributeTable.append(data);
        }
    });
}

function removePage(el) {
    var pageIndex = $(el).data("page-index");
    $('.page-' + pageIndex).remove();
}

function removeObject(el) {
    var object = $(el).parent().parent().parent().parent().parent();
    object.remove();
}

function removeAttribute(el) {
    var tbody = $(el).parent().parent().parent();
    if ($(tbody).children().length > 1) {
        var attribute = el.parent().parent();
        attribute.remove();
    }
}
$(document).ready(function () {
    $('.btn-get-update').on('click', function () {
        $.ajax({
            url: $('#base_url').text() + "/index.php/harvest/getData",
            type: "post",
            success: function (data) {
                alert(data);
            }
        });
    });
});


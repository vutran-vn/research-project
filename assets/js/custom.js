function addPage() {
    var pageIndex = ($('.page').length > 0) ? $('.page').last().data("page-index") + 1 : 1;
    $.ajax({
        url: $('#base_url').text() + "/index.php/config/addPage",
        data: {pageIndex: pageIndex},
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
    var attributeTable = $(el).parent().parent().parent().next().find('tbody').first();
    $.ajax({
        url: $('#base_url').text() + "/index.php/config/addAttribute",
        type: "post",
        success: function (data) {
            attributeTable.append(data);
        }
    });
}
function addObjectPage(el) {
    var objectElement = $(el).parent().parent().parent().next();
    var pageIndex = ($('.page').length > 0) ? $('.page').last().data("page-index") + 1 : 1;
    $.ajax({
        url: $('#base_url').text() + "/index.php/config/addPage",
        data: {pageIndex: pageIndex},
        type: "post",
        success: function (data) {
            $(objectElement).append(data);
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
function saveConfig() {
    //Prepare the configuration structure
    var form_data = {};
    form_data['website_url'] = $('#form-save').find("input[name='website_url']").val();
    form_data['analyse_structure'] = 'yes';
    form_data['pages'] = new Array();

    $('#form-save .pages > .page').each(function () {
        form_data['pages'].push(analyse_page(this));
    });

    $.ajax({
        url: $('#base_url').text() + "/index.php/config/save",
        type: "post",
        data: {config: JSON.stringify(form_data)},
        success: function (data) {
            if (data == 'OK') {
                $('#notification .modal-body').empty().append('<div class="alert alert-success" role="alert"> <strong>Save successfully!</strong></div>');
                $('#notification').modal("show");
            } else {
                $('#notification .modal-body').empty().append('<div class="alert alert-danger" role="alert"> <strong>Oops, save failed!</strong></div>');
                $('#notification').modal("show");
            }
        }
    });

    return false;
}
function analyse_page(pageElement) {
    var page = {};
    page['url'] = $(pageElement).find("input[name='page_url']").first().val();
    page['pattern'] = $(pageElement).find("input[name='page_pattern']").first().val();
    page['objects'] = new Array();

    $(pageElement).find(" > .panel-collapse > .object").each(function () {
        page['objects'].push(analyse_object(this));
    });
    return page;
}
function analyse_object(objectElement) {
    var object = {};
    object['name'] = $(objectElement).find("input[name='object_name']").first().val();
    object['attributes'] = analyse_attribute($(objectElement).find(".attributes").first());

    if ($(objectElement).find(" > .panel-default > .panel-body > .page").length > 0) {
        object['pages'] = new Array();
        $(objectElement).find(" > .panel-default > .panel-body > .page").each(function () {
            object['pages'].push(analyse_page($(this)));
        });
    }
    return object;
}
function analyse_attribute(attributeElement) {
    var attributes = new Array();
    if ($(attributeElement).find("input[name='attribute_name']").length > 0) {
        $(attributeElement).find("tbody tr").each(function () {
            var attribute = {};
            attribute['name'] = $(this).find("input[name='attribute_name']").val();
            attribute['sample'] = $(this).find("input[name='attribute_sample']").val();
            attribute['multiple'] = $(this).find("input[name='attribute_multiple']").is(":checked") ? 'yes' : 'no';
            attribute['full_text'] = $(this).find("input[name='attribute_full_text']").is(":checked") ? 'yes' : 'no';
            attribute['update'] = $(this).find("input[name='attribute_update']").is(":checked") ? 'yes' : 'no';
            attributes.push(attribute);
        });
    }
    return attributes;
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


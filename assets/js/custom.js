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
function saveConfig() {
    //Prepare the configuration structure
    var form_data = {};
    var page = {};
    var object = {};
    var attribute = {};

    $('#form-save input').each(function () {
        switch ($(this).attr('name')) {
            case 'website_url':
                form_data['website_url'] = $(this).val();
                form_data['analyse_structure'] = 'yes';
                form_data['pages'] = new Array();
                break;
            case 'page_url':
                page = {};
                object = {};
                attribute = {};

                page['url'] = $(this).val();
                page['objects'] = new Array();

                form_data['pages'].push(page);
                break;
            case 'page_pattern':
                page['pattern'] = $(this).val();
                break;
            case 'object_name':
                object = {};
                attribute = {};

                object['name'] = $(this).val();
                object['attributes'] = new Array();
                page['objects'].push(object);
                break;
            case 'attribute_name':
                attribute = {};

                attribute['name'] = $(this).val();
                object['attributes'].push(attribute);
                break;
            case 'attribute_sample':
                attribute['sample'] = $(this).val();
                break;
            case 'attribute_update':
                attribute['update'] = $(this).is(":checked") ? 'yes' : 'no';
                break;
        }
    });
//    $('.form-actions').append(JSON.stringify(form_data));
    $.ajax({
        url: $('#base_url').text() + "/index.php/config/save",
        type: "post",
        data: {config:JSON.stringify(form_data)},
        success: function (data) {
            if(data == 'OK') {
                $('.form-alerts').append('<div class="alert alert-success" role="alert"> <strong>Save successfully!</strong></div>');
            } else {
                $('.form-alerts').append('<div class="alert alert-danger" role="alert"> <strong>Oops, save failed!</strong></div>');
            }
        }
    });
    
    return false;
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


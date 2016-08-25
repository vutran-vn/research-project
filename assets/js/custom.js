$(document).ready(function () {
    $("#config-website .btn-add-page").click(function () {
        $.ajax({
            url: $('#base_url').text() + "/index.php/config/addPage",
            data: {pageIndex: $('.page').length + 1},
            type: "post",
            success: function (data) {
                $('.pages').append(data);
            }
        });
    });
});


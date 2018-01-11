$.fn.ajaxPost = function (success_callback) {
    var that = this;
    $(this).click(function () {
        var form_id = $(that).attr('post-form');
        var data = $(form_id).serialize();
        var url = $(form_id).attr('action');
        $.post(url, data, function (res) {
            success_callback(res);
        });
        return false;
    });
};
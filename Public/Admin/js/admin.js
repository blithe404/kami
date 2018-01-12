$(function () {
    var sidebar_active = function () {
        var link = $('.main').attr('sidebar-link');
        $('.nav-sidebar>li>a[href="' + link + '"]').parent().addClass('active');
    };

    $.fn.ajaxSubmit = function (reload) {
        $(this).on('click', function () {
            $('.alert-box').remove();
            var form = $(this).attr('submit-form');
            var text = $(this).text();
            var that = $(this);
            if (form === undefined) form = '#submit-form';
            $(this).attr('disabled', true);
            $(this).text('提交中');
            var data = $(form).serialize();
            var url = $(form).attr('action');
            $.post(url, data, function (res) {
                console.log(res);
                that.attr('disabled', false);
                that.text(text);
                if (res) {
                    if (res.status == 0) {
                        show_message(res.status, res.info, res.url, reload);
                    } else if (res.status == 1) {
                        show_message(res.status, res.info, res.url, reload);
                    } else {
                        show_message(res.status, res.info, res.url, reload);
                    }
                } else {
                    show_message(0, '提交失败');
                }
            });
            return false;
        });
    };

    var confirm = function (btn_id) {
        $('.' + btn_id).click(function () {
            var confirmtext = $(this).attr('confirm-text');
            var confirmtip = $(this).attr('confirm-tip');
            var title = $(this).text().trim();
            if (typeof(confirmtext) == "undefined") confirmtext = '确定执行此操作？';
            if (typeof(confirmtip) == "undefined") confirmtip = title;
            var target = $(this).attr('url');
            if (typeof(target) == "undefined") target = $(this).attr('href');
            var confirm_box = '<div class="modal fade" id="' + btn_id + 'Modal" tabindex="-1" role="dialog" aria-labelledby="' + btn_id + 'ModalLabel">\n' +
                '  <div class="modal-dialog" role="document">\n' +
                '    <div class="modal-content">\n' +
                '      <div class="modal-header">\n' +
                '        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>\n' +
                '        <h4 class="modal-title" id="' + btn_id + 'ModalLabel">' + confirmtip + '</h4>\n' +
                '      </div>\n' +
                '      <div class="modal-body">\n' +
                '         <h3 class="text-danger text-center">' + confirmtext + '</h3>\n' +
                '      </div>\n' +
                '      <div class="modal-footer">\n' +
                '        <button type="button" class="btn btn-danger" id="' + btn_id + '-btn">确定</button>\n' +
                '        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>\n' +
                '      </div>\n' +
                '    </div>\n' +
                '  </div>\n' +
                '</div>';
            $('body').prepend(confirm_box);
            $('#' + btn_id + 'Modal').modal();
            var is_success = -1;
            var res_info = '';
            $('#' + btn_id + 'Modal').on('hidden.bs.modal', function () {
                if(is_success === 1) {
                    show_message(1, res_info);
                } else if(is_success === 0) {
                    show_message(0, res_info, null ,true);
                }
                $('#' + btn_id + 'Modal').remove();
            });
            $('#' + btn_id + '-btn').on('click', function () {
                var data = {};
                $.get(target, data, function(res) {
                    res_info = res.info;
                    if(res.status == 1) {
                        is_success = 1;
                        $('#' + btn_id + 'Modal').modal('toggle');
                    } else {
                        is_success = 0;
                        $('#' + btn_id + 'Modal').modal('toggle');
                    }
                });
            });
            return false;
        });
    };
    sidebar_active();
    confirm('confirm');
});
var show_message = function (status, info, url, reload) {
    var status_arr = new Array();
    status_arr[0] = 'alert-danger';
    status_arr[1] = 'alert-success';
    var alert_box = '<div class="container alert-box">' +
        '<div class="alert ' + status_arr[status] + '">' + info + '</div>'
    '</div>';
    $('body').prepend(alert_box);
    if (url) {
        $('.alert').append('<a href="' + url + '" class="alert-link">立即跳转</a>');
    }
    if (!reload) {
        setTimeout(function () {
            if (url) {
                window.location.href = url;
            } else {
                window.location.reload();
            }
        }, 2000);
    } else {
        setTimeout(function () {
            $('.alert-box').remove();
            if (url) {
                window.location.href = url;
            }
        }, 2000);
    }
};
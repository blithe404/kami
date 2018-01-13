<?php if (!defined('THINK_PATH')) exit(); if(!IS_AJAX){ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>
        <?php if(!empty($meta_title)): echo ($meta_title); ?>-<?php endif; ?>
        <?php echo (C("SITE_NAME")); ?>
    </title>
    <link rel="stylesheet" href="/Public/Admin/css/layui.css">
    <script src="/Public/Admin/layui.js"></script>
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
    <div class="layui-header">
        <div class="layui-logo"><?php echo (C("SITE_NAME")); ?></div>
        <ul class="layui-nav layui-layout-right" lay-filter="admin-nav">
            <li class="layui-nav-item">
                <a href="javascript:;"><?php echo (ANAME); ?></a>
                <dl class="layui-nav-child">
                    <dd data-url="<?php echo U('Admin/changePwd');?>"><a href="javascript:;">修改密码</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item" data-url="<?php echo U('Admin/logout');?>"><a href="javascript:;">退了</a></li>
        </ul>
    </div>

<div class="layui-body">
    <div class="layui-main" style="padding:20px;">
        <?php } ?>
        
<blockquote class="layui-elem-quote">
    <div class="layui-inline">
        <div class="layui-input-inline">
            <input value="" placeholder="请输入<?php echo ($keyword); ?>" class="layui-input search_input" type="text">
        </div>
        <a class="layui-btn search_btn">查询</a>
    </div>
    <div class="layui-inline">
        <a class="layui-btn layui-btn-normal add_btn">添加<?php echo ($keyword); ?></a>
    </div>
</blockquote>
<table id="list" lay-filter="list"></table>

<script type="text/html" id="datetimeTpl">
    {{ layui.util.toDateString(parseInt(d.datetime)*1000, 'yyyy-MM-dd HH:mm:ss') }}
</script>

<script type="text/html" id="idcardTpl">
    {{# if(d.idcard_img) { }}
    <a href="{{ d.idcard_img }}" target="_blank" class="layui-btn-primary layui-btn-xs">查看</a>
    {{# } }}
</script>

<script type="text/html" id="opBar">
    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>

<script>
    layui.use(['table', 'util', 'jquery', 'layer'], function () {
        var table = layui.table;
        var $ = layui.jquery;
        var layer = layui.layer;
        var url = "<?php echo U('lists');?>";

        var list = table.render({
            elem: '#list',
            url: url,
            page: true,
            cols: [[
                {field: 'username', title: '用户名', align: 'center', fixed: 'left'},
                {field: 'email', title: '邮箱', align: 'center'},
                {field: 'realname', title: '姓名', align: 'center'},
                {field: 'idcard', title: '身份证', align: 'center'},
                {field: 'bankcard', title: '银行卡', align: 'center'},
                {field: 'bank', title: '所属银行', align: 'center'},
                {field: 'balance', title: '站点余额', align: 'center'},
                {field: 'idcard_img', title: '证件照', align: 'center', templet: '#idcardTpl'},
                {field: 'ip', title: '登录IP', align: 'center'},
                {field: 'datetime', title: '注册日期', align: 'center', templet: '#datetimeTpl'},
                {title: '操作', align: 'center', fixed: 'right', toolbar: '#opBar', width: 150}
            ]],
        });

        table.on('tool(list)', function (obj) {
            var data = obj.data;
            var event = obj.event;
            var tr = obj.tr;

            if(event === 'edit') {
                var url = "<?php echo U('edit');?>";
                var get = {id:data.id};
                $.get(url, get, function (html) {
                    layer.open({
                        type: 1,
                        content: html,
                        area: ['600px', '600px'],
                        shadeClose: true
                    });
                });
            } else if (event === 'del') {
                layer.confirm('确认删除', function (index) {
                    var url = "<?php echo U('delete');?>";
                    var post = {id:data.id};
                    $.post(url, post, function (res) {
                        if(res.status == 0) {
                            layer.msg(res.info);
                        } else {
                            layer.msg(res.info, {time:1000}, function () {
                                obj.del();
                                layer.close(index);
                            })
                        }
                    });
                });
            }

        });

        $('.search_btn').click(function () {
            var keyword = $('.search_input').val();
            var url = "<?php echo U('search');?>";
            list.reload({
                where: {
                    keyword: keyword
                },
                url: url
            });
        });

        $('.add_btn').click(function () {
            var url = "<?php echo U('add');?>";
            var data = {};
            $.get(url, data, function (html) {
                layer.open({
                    type: 1,
                    content: html,
                    area: ['600px', '600px'],
                    shadeClose: true
                });
            });
        });
    })
</script>
        <?php if(!IS_AJAX){ ?>
    </div>
</div>
<div class="layui-footer">
    <!-- 底部固定区域 -->
    © <?php echo getDomain();?>
</div>
</div>
<script>
    layui.use(['element', 'layer'], function () {
        var element = layui.element;
        var $ = layui.jquery;
        element.on('nav(menu-nav)', function (elem) {
            var url = $(elem).attr('data-url');
            var data = {};
            $.get(url,data,function (html) {
                $('.layui-main').html(html);
            })
        });
        element.on('nav(admin-nav)', function (elem) {
            var url = $(elem).attr('data-url');
            var data = {};
            $.get(url, data, function (res) {
                if(res.url) {
                    window.location.href = res.url;
                } else {
                    $('.layui-main').html(res);
                }
            });
        });
    });
</script>
</body>
</html>
<?php } ?>
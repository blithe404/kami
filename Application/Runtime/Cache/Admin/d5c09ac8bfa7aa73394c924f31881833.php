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
</blockquote>
<table id="list" lay-filter="list"></table>

<script>
    layui.use(['table', 'util', 'jquery', 'layer'], function () {
        var table = layui.table;
        var $ = layui.jquery;
        var layer = layui.layer;
        var url = "<?php echo U('order_lists');?>";

        var list = table.render({
            elem: '#list',
            url: url,
            page: true,
            cols: [[
                {field: 'username', title: '用户名', align: 'center', fixed: 'left'},
                {field: 'pname', title: '商品名称', align: 'center'},
                {field: 'price', title: '单价', align: 'center'},
                {field: 'number', title: '数量', align: 'center'},
                {field: 'total_price', title: '付款金额', align: 'center'},
                {field: 'status', title: '状态', align: 'center', templet: '#statusTpl'},
                {field: 'datetime', title: '创建日期', align: 'center', templet: '#datetimeTpl'},
                {title: '操作', align: 'center', fixed: 'right', toolbar: '#opBar'}
            ]],
        });

        table.on('tool(list)', function (obj) {
            var data = obj.data;
            var event = obj.event;

            if(event === 'send') {
                var url = "<?php echo U('setOrderStatus');?>";
                var post = {id:data.id,status:2};
                layer.confirm('是否确认发货', function (index) {
                    $.post(url, post, function (res) {
                        if(res.status == 0) {
                            layer.msg(res.info);
                        } else {
                            layer.msg(res.info, {time:1000}, function () {
                                layer.close(index);
                                list.reload();
                            });
                        }
                    });
                });
            }

        });

        $('.search_btn').click(function () {
            var keyword = $('.search_input').val();
            var url = "<?php echo U('order_search');?>";
            list.reload({
                where: {
                    keyword: keyword
                },
                url: url
            });
        });
    })
</script>

<script type="text/html" id="opBar">
    {{# if(d.status == 1) { }}
    <a class="layui-btn layui-btn-xs" lay-event="send">发货</a>
    {{# } }}
</script>

<script type="text/html" id="datetimeTpl">
    {{ layui.util.toDateString(parseInt(d.datetime)*1000, 'yyyy-MM-dd HH:mm:ss') }}
</script>
<script type="text/html" id="statusTpl">
    {{# if(d.status == 0) { }}
    <span style="color:red;">未支付</span>
    {{# } else if(d.status == 1) { }}
    <span style="color:chartreuse">已支付</span>
    {{# } else if(d.status == 2) { }}
    <span style="color:deepskyblue">已发货</span>
    {{# } }}
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
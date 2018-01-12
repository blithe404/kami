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
<?php if(!IS_AJAX){ ?>
<div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
        <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
        <ul class="layui-nav layui-nav-tree" lay-filter="menu-nav">
            <li class="layui-nav-item layui-nav-itemed">
                <a class="" href="javascript:;">用户管理</a>
                <dl class="layui-nav-child">
                    <dd data-url="<?php echo U('User/index');?>"><a href="javascript:;">用户列表</a></dd>
                    <dd data-url="<?php echo U('User/order');?>"><a href="javascript:;">订单列表</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item layui-nav-itemed">
                <a class="" href="javascript:;">商品管理</a>
                <dl class="layui-nav-child">
                    <dd data-url="<?php echo U('ProductCategory/index');?>"><a href="javascript:;">商品分类</a></dd>
                    <dd data-url="<?php echo U('Product/index');?>"><a href="javascript:;">商品列表</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item layui-nav-itemed">
                <a class="" href="javascript:;">账户管理</a>
                <dl class="layui-nav-child">
                    <dd data-url="<?php echo U('Bank/index');?>"><a href="javascript:;">账户列表</a></dd>
                </dl>
            </li>
        </ul>
    </div>
</div>
<?php } ?>
<div class="layui-body">
    <div class="layui-main" style="padding:20px;">
        <?php } ?>
        
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
        var layer = layui.layer;
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
        });
    });
</script>
</body>
</html>
<?php } ?>
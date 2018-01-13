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
        
<style>
    .logo-height {
        height: 102px;
    }
    .logo-width {
        width: 251px;
    }
    .flex {
        display: flex;
    }
    .flex-1 {
        flex: 1;
    }
    .pointer {
        cursor: pointer;
    }
    .left-height {
        height: 449px;
    }
    .mgl-251 {
        margin-left: 251px;
    }
    .banner-height {
        height: 312px;
    }
    .banner-width {
        width: 752px;
    }
    .img-width {
        width: 185px;
    }
    .img-height {
        height: 136px;
    }
    .img-mgr {
        margin-right: 0px;
    }
</style>
<blockquote class="layui-elem-quote">
    <p>点击图片上传</p>
</blockquote>
<div class="flex">
    <div>
        <img src="<?php echo ($img['logo']['path']); ?>" key="logo" class="logo-height logo-width pointer logo">
    </div>
    <div class="layui-bg-green banner-width"></div>
</div>
<div class="left-height">
    <div class="flex banner-height">
        <div class="layui-bg-green left-height logo-width"></div>
        <div>
            <img src="<?php echo ($img['banner']['path']); ?>" key="banner" class="banner-width banner-height pointer img">
        </div>
    </div>
    <div class="mgl-251">
        <img src="<?php echo ($img['img1']['path']); ?>" key="img1" class="pointer img-mgr img-width img-height img">
        <img src="<?php echo ($img['img2']['path']); ?>" key="img2" class="pointer img-mgr img-width img-height img">
        <img src="<?php echo ($img['img3']['path']); ?>" key="img3" class="pointer img-mgr img-width img-height img">
        <img src="<?php echo ($img['img4']['path']); ?>" key="img4" class="pointer img-mgr img-width img-height img">
    </div>
</div>
<script>
    layui.use(['jquery', 'layer'], function () {
        var $ = layui.jquery;
        $('.img').click(function () {
            var name = $(this).attr('key');
            var url = "<?php echo U('img');?>";
            var data = {name:name};
            $.get(url, data, function (html) {
                layer.open({
                    type: 1,
                    content: html,
                    area: ['600px', '600px'],
                    shadeClose: true
                })
            });
        });

        $('.logo').click(function () {
            var name = $(this).attr('key');
            var url = "<?php echo U('logo');?>";
            var data = {name:name};
            $.get(url, data, function (html) {
                layer.open({
                    type: 1,
                    content: html,
                    area: ['600px', '600px'],
                    shadeClose: true
                })
            });
        });
    });
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
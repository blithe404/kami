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
        
<form action="<?php echo U();?>" method="post" class="layui-form" style="padding:20px;">
    <div class="layui-form-item">
        <label class="layui-form-label">电子邮箱</label>
        <div class="layui-input-block">
            <input type="text" name="email" value="<?php echo ($data["email"]); ?>" lay-verify="required|email" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">真实姓名</label>
        <div class="layui-input-block">
            <input type="text" name="realname" value="<?php echo ($data["realname"]); ?>" lay-verify="required" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">身份证</label>
        <div class="layui-input-block">
            <input type="text" name="idcard" value="<?php echo ($data["idcard"]); ?>" lay-verify="required|identity" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">站点余额</label>
        <div class="layui-input-block">
            <input type="text" name="balance" value="<?php echo ($data["balance"]); ?>" lay-verify="required|number" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">银行卡号</label>
        <div class="layui-input-block">
            <input type="text" name="bankcard" value="<?php echo ($data["bankcard"]); ?>" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">所属银行</label>
        <div class="layui-input-block">
            <input type="text" name="bank" value="<?php echo ($data["bank"]); ?>" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <input type="hidden" name="id" value="<?php echo ($data["id"]); ?>">
            <button class="layui-btn" lay-submit lay-filter="*" post-form=".layui-form">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
<script>
    layui.use(['form', 'jquery'], function () {
        var form = layui.form;
        var $ = layui.jquery;
        form.on('submit(*)', function (data) {
            var post = data.field;
            var url = data.form.action;
            $.post(url, post, function (res) {
                if(res.status == 0) {
                    layer.msg(res.info);
                } else {
                    layer.msg(res.info, {time:1000}, function () {
                        layer.closeAll();
                    });
                }
            });
            return false;
        })
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
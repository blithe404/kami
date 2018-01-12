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
        <label class="layui-form-label">商品名称</label>
        <div class="layui-input-block">
            <input type="text" name="name" value="<?php echo ($data["name"]); ?>" lay-verify="required" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">所属分类</label>
        <div class="layui-input-block">
            <select name="cid" lay-verify="required">
                <?php if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><option value="<?php echo ($item["id"]); ?>" <?php if(($data["cid"]) == $item["id"]): ?>selected<?php endif; ?> ><?php echo ($item["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">单价</label>
        <div class="layui-input-block">
            <input type="text" name="price" value="<?php echo ($data["price"]); ?>" lay-verify="required|number" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">销量</label>
        <div class="layui-input-block">
            <input type="text" name="sale" value="<?php echo ($data["sale"]); ?>" lay-verify="required|number" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">图片</label>
        <div class="layui-input-inline">
            <button type="button" class="layui-btn layui-btn-radius layui-btn-primary" id="upload-btn">
                <i class="layui-icon">&#xe67c;</i>上传图片
            </button>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <input type="hidden" id="img" name="img" value="<?php echo ($data["img"]); ?>">
            <input type="hidden" id="id" name="id" value="<?php echo ($data["id"]); ?>">
            <button class="layui-btn" lay-submit lay-filter="*" post-form=".layui-form">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
<script>
    layui.use(['form', 'jquery', 'upload'], function () {
        var form = layui.form;
        var $ = layui.jquery;
        var upload = layui.upload;

        upload.render({
            elem: '#upload-btn',
            url: '<?php echo U('File/ajaxUpload?type=PRODUCT');?>',
            done: function (res) {
                if (res.status == 1) {
                    layer.msg('上传成功');
                    $('#img').val(res.path);
                } else {
                    layer.msg(res.info);
                }
            },
            error: function () {
                //请求异常回调
                layer.msg('上传失败');
            }
        });

        form.render('select');

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
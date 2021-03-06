<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo ($meta_title); ?></title>
    <link rel="stylesheet" href="/Public/Admin/css/layui.css">
    <style>
        .login {
            height: 220px;
            width: 260px;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 4px;
            position: absolute;
            left: 50%;
            top: 50%;
            margin: -150px 0 0 -150px;
            z-index: 99;
        }

        .login h1 {
            text-align: center;
            color: #fff;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form_code {
            position: relative;
        }

        .form_code .code {
            position: absolute;
            right: 0;
            top: 1px;
            cursor: pointer;
        }

        .login_btn {
            width: 100%;
        }
    </style>
</head>
<body>
<div class="login">
    <h1><?php echo ($meta_title); ?></h1>
    <form class="layui-form">
        <div class="layui-form-item">
            <input class="layui-input" name="name" placeholder="用户名" lay-verify="required" type="text"
                   autocomplete="off">
        </div>
        <div class="layui-form-item">
            <input class="layui-input" name="password" placeholder="密码" lay-verify="required" type="password"
                   autocomplete="off">
        </div>
        <button class="layui-btn login_btn" lay-submit lay-filter="*" post-form=".layui-form">登录</button>
    </form>
</div>
<script src="/Public/Admin/layui.js"></script>
<script type="text/javascript">
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
                    window.location.href = res.url;
                }
            });
            return false;
        })
    });
</script>
</body>
</html>
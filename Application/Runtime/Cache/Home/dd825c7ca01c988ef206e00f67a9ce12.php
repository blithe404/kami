<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title><?php echo ($meta_title); ?></title>
    <link rel="stylesheet" href="/Public/home/css/common.css">
    <link rel="stylesheet" href="/Public/home/css/style.css">

    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <script src="/Public/home/js/common.js"></script>
</head>
<body>
<div id="header">
    <div class="top">
        <div class="contain">
            <span class="fr">
                <a href="<?php echo U('User/index');?>">会员中心</a> |
                <a href="<?php echo U('PayOrder/create');?>">充值</a> |
                <a href="javascript:void(0);">站点余额：<?php echo (UBLANCE); ?>元</a>
            </span>
            <div id="jl_usrBox">
                你好，欢迎来到<?php echo ($confs["site_name"]); ?>！
                <?php if(empty(UID)): ?><a href="<?php echo U('User/register');?>">注册</a> |
                    <a href="<?php echo U('User/login');?>">登录</a>
                <?php else: ?>
                    <a href="javascript:void(0)"><?php echo (UNAME); ?></a>
                    <a href="<?php echo U('User/logout');?>">退出</a><?php endif; ?>
            </div>
        </div>
    </div>
    <div class="contain">
        <a href="/">
            <img src="/Public/home/imgs/home_logo.png" class="logo" width="218"
                 heigth="83">
        </a>
        <div class="search">
            <div class="searArea">
                <form action="<?php echo U('Product/lists');?>" method="get">
                    <input type="text" name="keyword" placeholder="热门" value="">
                    <input type="submit" value="搜索">
                </form>
            </div>
            <div gishop="word" id="adVt1">
                <p>
                    热搜： <a href="<?php echo U('Product/lists/cat=盛大');?>">盛大</a>
                </p>
            </div>
        </div>
    </div>
</div>

<form action="<?php echo U();?>" id="subForm" method="post">
    <div id="wrap">
        <div class="warmAtion"><img src="/Public/home/imgs/icon_4.jpg">温馨提示：请认真核对下单信息。</div>
        <div class="person">
            <dl>
                <dt>确认下单信息</dt>
                <dd class="info">
                    <div class="des">
                        <p>商品名称: <span class="blue" id="productName" name="productName">盛大直充</span></p>
                        <p>商品类型: 直充</p>
                        <p>单价: <font id="salePrice" name="salePrice">1</font>元</p>
                    </div>
                    <div class="count">
                        应付金额:
                        <span class="orange">
                            ￥<span class="font24" id="salePriceTotal">1</span>
                        </span>
                    </div>
                    <div class="num">数量：
                        <span class="numControl">
                            <input type="text" name="number" id="number" class="number" value="1">
                            <img class="up_img" src="/Public/home/imgs/icon_up.jpg" style="position:absolute;top:0;right:0;">
                            <img class="down_img" src="/Public/home/imgs/icon_down.jpg" style="position:absolute;bottom:0;right:0;">
                        </span>
                    </div>
                    <br clear="all">
                </dd>
            </dl>
            <div class="doSumbie">
                <input type="submit" value="提交订单" class="btnSumbit" id="sub-btn" post-form="#subForm">
            </div>
        </div>
    </div>
</form>
<script>
    var price = $('#salePrice').text().trim() - 0;

    $('.up_img').click(function () {
        var old_num = $('#number').val() - 0;
        var new_num = old_num + 1;
        $('#number').val(new_num);
        $('#salePriceTotal').text(new_num * price);
    });
    $('.down_img').click(function () {
        var old_num = $('#number').val() - 0;
        var new_num = old_num - 1;
        if(new_num == 0) {
            new_num = 1;
        }
        $('#number').val(new_num);
        $('#salePriceTotal').text(new_num * price);
    });

    $('.number').blur(function () {
        var val = $(this).val();
        if(!isInteger(val)) {
            $(this).val(1);
            $('#salePriceTotal').text(price);
        }
    });

    function isInteger(obj) {
        return obj%1 === 0
    }
</script>
<div id="footer">
    <div class="contain">
        <ul>
            <li><h3>支付方式</h3><a href="#">微信支付流程</a><br><a
                    href="#">网银支付流程</a></li>
            <li><h3>新手指南</h3><a href="#">新手必读</a><br><a
                    href="#">找回密码</a><br><a
                    href="#">购买流程</a><br><a
                    href="#">账户注册</a></li>
            <li><h3>关于我们</h3><a href="#">免责声明</a><br><a
                    href="#">企业简介</a><br><a
                    href="#">联系我们</a><br><a
                    href="#">商务咨询</a></li>
            <li><h3>操作说明</h3><a href="#">异常发货须知</a><br><a
                    href="#">退换货说明</a><br><a
                    href="#">商品配送</a><br><a
                    href="#">常见问题</a><br><a
                    href="#">如何查看卡密信息</a></li>
        </ul>
        <br clear="all">
        <p>
            <a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=43011102000132"
               style="display:inline-block;text-decoration:none;height:12px;line-height:12px;color:#7f7e7e;"><img
                    src="/Public/home/imgs/galogo.png" style="float:left;"><span
                    style="float:left;height:12px;line-height:12px;margin: 0px 0px 0px 5px;">湘公网安备 43011102000132号</span></a>
            | 湘ICP备15002757号-2 | 湘网文(2015)1313-010号 <br><span>法律顾问：盈科律师事务所-何箭</span><br>
        </p>
        <p>Copyright 2016-2018湖南省快游通网络技术有限公司(<a href="upload/20171122/20171122101115881.jpg">执照信息</a>)Copyright
            2016-2018湖南乐维网络科技有限公司(<a href="upload/20171122/20171122101258096.jpg">执照信息</a>)</p>
        <p></p>
    </div>

</div>
</body>
</html>
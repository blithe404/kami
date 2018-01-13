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
<div class="warn">
    <img src="/Public/home/imgs/icon_4.jpg">
    严正警告：任何以“兼职”，“刷信誉”，“网购退款”，“提升额度”，“二手交易担保收款”为借口的必为诈骗行为，请高度警惕，谨防上当!
    <a href="javascript:void(0);" class="close">x</a>
</div>
<div id="header">
    <div class="top">
        <div class="contain">
            <span class="fr">
                <a href="<?php echo U('User/index');?>">会员中心</a> |
                <a href="<?php echo U('PayOrder/create');?>">充值</a>
                <?php if(!empty(UID)): ?>| <a href="javascript:void(0);">站点余额：<?php echo (UBLANCE); ?>元</a><?php endif; ?>
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
            <img src="<?php echo ($img['logo']['path']); ?>" class="logo" width="218"
                 heigth="83">
        </a>
        <div class="search">
            <div class="searArea">
                <form action="<?php echo U('Product/lists');?>" method="get">
                    <input type="text" name="keyword" placeholder="" value="">
                    <input type="submit" value="搜索">
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    #sub-btn {
        width: 93px;
        height: 28px;
        background: url(/Public/home/imgs/button_bg_1.jpg) no-repeat;
        cursor: pointer;
        border: 0;
        margin-top: 10px;
        color: #fff;
        font-size: 14px;
        margin-left: 178px;
    }
</style>
<div id="wrap">
    <div class="person" style="border:none">
        <form action="<?php echo U();?>" id="subForm" method="post">
            <dl>
                <dt>请选择汇款账户</dt>
                <dd>
                    <?php if(is_array($banks)): $i = 0; $__LIST__ = $banks;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$bank): $mod = ($i % 2 );++$i;?><div style="height:45px;line-height:45px;">
                            <div style="width:30%;text-align:center;display:inline-block">
                                <input type="radio" name="bank_id" value="<?php echo ($bank["id"]); ?>">
                                <?php echo ($bank["title"]); ?>
                            </div>
                            <div style="width:30%;text-align:center;display:inline-block;"><?php echo ($bank["name"]); ?></div>
                            <div style="width:35%;text-align:center;display:inline-block;"><?php echo ($bank["card"]); ?></div>
                        </div><?php endforeach; endif; else: echo "" ;endif; ?>
                </dd>
            </dl>
            <dl>
                <dt>请填写汇款信息</dt>
                <dd class="address">
                    <ul>
                        <li>
                            <span class="name"><span class="red">*</span>汇款金额：</span>
                            <span class="fill">
                                <input type="number" id="money" name="money">
                                <span style="color:red;">汇款金额以100为单位</span>
                            </span>
                        </li>
                        <li>
                            <span class="name"><span class="red">*</span>汇款时间：</span>
                            <span class="fill">
                            <input type="datetime-local" id="paytime" name="paytime">
                        </span>
                        </li>
                        <li>
                            <span class="name">汇款备注信息：</span>
                            <span class="fill">
                            <textarea name="remark" id="remark" cols="50" rows="10"></textarea>
                        </span>
                        </li>
                    </ul>
                    <p><input type="submit" id="sub-btn" post-form="#subForm" value="提交"></p>
                </dd>
            </dl>
        </form>
    </div>
</div>
<script>
    $(function () {
        alert('<?php echo ($confs["qq"]); ?>');
    });
    $('#sub-btn').ajaxPost(function (res) {
        console.log(res);
        if (res.status == -10) {
            window.location.href = res.url;
        } else if (res.status == 0) {
            alert(res.info);
        } else {
            window.location.href = res.url;
        }
    })
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
<script>
    $(function () {
        $('.warn .close').click(function () {
            $('.warn').remove();
        });
    });
</script>
</body>
</html>
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
                <a href="javascript:void(0);">站点余额：0元</a>
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

<div id="wrap">
    <div class="admin">
        <div class="menu">
            <h3>用户中心</h3>
            <ul>
                <?php if(ACTION_NAME == 'index') { $index_sel = 'class="sel"'; } else if (ACTION_NAME == 'orderList') { $order_sel = 'class="sel"'; } ?>
                <li><a href="<?php echo U('User/index');?>" <?php echo ($index_sel); ?>><span class="icoBg ico-1"></span>
                    <p>个人中心</p>我的个人信息</a></li>
                <li><a href="<?php echo U('User/orderList');?>" <?php echo ($order_sel); ?>><span class="icoBg ico-2"></span>
                    <p>我的订单</p>查看我的订单信息</a></li>
            </ul>
        </div>
        <div class="admin-wrap">
            <div style="height:150px" class="admin-info"><img src="/Public/home/imgs/image_default.jpg" width="109"
                                                              height="109" class="fl">
                <div class="fl" style="padding-left:10px;">
                    <ul>
                        <li class="li-h">欢迎您 <span class="orange"><?php echo ($data["username"]); ?></span> 来到<?php echo ($confs["site_name"]); ?>用户中心</li>
                        <li></li>
                        <li class="li-h">上次登陆: IP <?php echo ($data["ip"]); ?> <?php echo date('Y-m-d H:i:s', $data['updatetime']); ?></li>
                        <li></li>
                        <li class="li-h"><a href="<?php echo U('User/changePwd');?>">[修改密码]</a></li>
                    </ul>
                </div>
            </div>
            <h3>个人资料</h3>
            <div class="info-aiton">请填写正确的个人资料信息，方便我们及时联系您。</div>
            <div class="info-list">
                <form action="<?php echo U();?>" method="post" id="subForm">
                    <!--<h4>用户信息</h4>-->
                    <!--<ul>-->
                        <!--<li>-->

                            <!--<span class="name">用户id：</span>-->
                            <!--<span class="fill red font14 b">010001515613624306</span>-->
                            <!--<input type="hidden" name="userId" value="010001515613624306">-->
                        <!--</li>-->

                    <!--</ul>-->
                    <h4>高级信息</h4>
                    <ul>
                        <li>
                            <span class="name">邮箱：</span>
                            <span class="fill">
								<input type="text" name="email" class="email" value="<?php echo ($data["email"]); ?>">
							</span>
                        </li>
                    </ul>
                    <h4>实名认证信息</h4>
                    <ul>
                        <li>
                            <span class="name">姓名：</span>
                            <span class="fill">
								<input type="text" name="realname" class="realName" value="<?php echo ($data["realname"]); ?>">
							</span>
                        </li>
                        <li>
                            <span class="name">身份证号码：</span>
                            <span class="fill">
								<input type="text" name="idcard" class="idnum" value="<?php echo ($data["idcard"]); ?>">
							</span>
                        </li>
                        <li>
                            <span class="name">银行卡号：</span>
                            <span class="fill">
								<input type="text" name="bankcard" class="idnum" value="<?php echo ($data["bankcard"]); ?>">
							</span>
                        </li>
                        <li>
                            <span class="name">所属银行：</span>
                            <span class="fill">
								<input type="text" name="bank" class="idnum" value="<?php echo ($data["bank"]); ?>">
							</span>
                        </li>
                    </ul>
                    <p><input type="submit" id="sub-btn" post-form="#subForm" value="保存"></p>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('#sub-btn').ajaxPost(function (res) {
        if(res.status == -1) {

        } else if (res.status == 0) {
            alert(res.info);
        } else {
            window.location.reload();
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
</body>
</html>
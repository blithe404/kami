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

<div class="nav">
    <div class="contain">
        <div class="title">全部商品分类</div>
        <ul gishop="word">
            <li><a href="/">首页</a></li>
            <li><a href="/">Q币</a></li>
            <li><a href="/">话费</a></li>
            <li><a href="/">盛大</a></li>
        </ul>
    </div>
</div>
<div id="wrap">
    <div class="index-sort">
        <ul>
            <li gishop="category">
                <h5>热售商品</h5>
                <a href="/" class="gray">
                    <span>盛付通</span>
                </a>
                <a href="/" class="gray">
                    <span>盛付通</span>
                </a>
                <a href="/" class="gray">
                    <span>盛付通</span>
                </a>
            </li>
            <li gishop="category">
                <h5>热售商品</h5>
                <a href="/" class="gray">
                    <span>盛付通</span>
                </a>
                <a href="/" class="gray">
                    <span>盛付通</span>
                </a>
                <a href="/" class="gray">
                    <span>盛付通</span>
                </a>
            </li>
            <li gishop="category">
                <h5>热售商品</h5>
                <a href="/" class="gray">
                    <span>盛付通</span>
                </a>
                <a href="/" class="gray">
                    <span>盛付通</span>
                </a>
                <a href="/" class="gray">
                    <span>盛付通</span>
                </a>
            </li>
            <li gishop="category">
                <h5>热售商品</h5>
                <a href="/" class="gray">
                    <span>盛付通</span>
                </a>
                <a href="/" class="gray">
                    <span>盛付通</span>
                </a>
                <a href="/" class="gray">
                    <span>盛付通</span>
                </a>
            </li>
            <li class="category liNone">
                <h5>热售商品</h5>
                <a href="/" class="gray">
                    <span>盛付通</span>
                </a>
                <a href="/" class="gray">
                    <span>盛付通</span>
                </a>
                <a href="/" class="gray">
                    <span>盛付通</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="index-show">
        <div class="img-roll">
            <div class="slide-main">
                <img src="/Public/home/imgs/qbi.png" width="771" height="312" alt="">
            </div>
        </div>
        <div class="img-quick">
            <a href="/" target="_blank">
                <img src="/Public/home/imgs/qb_pay.jpg" width="185" height="136">
            </a>
            <a href="/" target="_blank">
                <img src="/Public/home/imgs/qb_pay.jpg" width="185" height="136">
            </a>
            <a href="/" target="_blank">
                <img src="/Public/home/imgs/qb_pay.jpg" width="185" height="136">
            </a>
            <a href="/" target="_blank">
                <img src="/Public/home/imgs/qb_pay.jpg" width="185" height="136">
            </a>
        </div>
    </div>
    <div class="index-pay">
        <div gishop="pic" id="adVt10">
            <a href="/" target="_blank">
                <img width="230" height="146" src="/Public/home/imgs/shenda-pay.jpg">
            </a>
        </div>
        <dl id="payId">
            <dt>
                <a href="javascript:void(0);" class="payCont1 sel" onclick="menuSwitch('payId','payCont1');">话费</a>
                <a href="javascript:void(0);" class="payCont2" onclick="menuSwitch('payId','payCont2');">点卡</a>
                <a href="javascript:void(0);" class="payCont3" onclick="menuSwitch('payId','payCont3');">Q币</a>
            </dt>
            <dd>
                <!--话费-->
                <ul id="payCont1">
                    <li>
                        <img src="/Public/home/imgs/icon_phone.png">
                        <input type="text" id="mobile" maxlength="11" class="input-t1" style="width:180px;"
                               placeholder="请输入手机号码">
                    </li>
                    <li></li>
                    <li></li>
                    <li>
                        <img src="/Public/home/imgs/icon_money.png">
                        <select name="select" id="txt_callName" style="width:120px">
                            <option>请选择面额</option>
                        </select>
                    </li>
                    <li><input type="submit" value="立即充值"></li>
                </ul>
                <!--点卡-->
                <ul id="payCont2" class="hid">
                    <li>
                        <img src="/Public/home/imgs/icon_phone.png">
                        <select name="select" id="txt_cardGameName" style="width:180px">
                            <option>请选择游戏</option>
                        </select>
                    </li>
                    <li>
                        <img src="/Public/home/imgs/icon_money.png">
                        <select name="select" id="txt_cardFaceValue" style="width:180px">
                            <option>请选择面额</option>
                        </select>
                    </li>
                    <li></li>
                    <li></li>
                    <li><input type="submit" name="Submit" value="立即充值"></li>
                </ul>
                <!--Q币-->
                <ul id="payCont3" class="hid">
                    <li><img src="/Public/home/imgs/icon_money.png">
                        <input type="number" id="qqBuyNum" name="qqBuyNum" maxlength="6" class="input-t1"
                               style="width:180px;" placeholder="请输入购买数量">
                    </li>
                    <li></li>
                    <li><input type="submit" name="Submit" value="立即充值"></li>
                </ul>
            </dd>
        </dl>
    </div>
    <div style="clear: both;"></div>
</div>
<script>
    function menuSwitch(id, rel) {
        $("#" + id).find("dt").find("a").removeClass("sel");
        $("#" + id).find("." + rel).addClass("sel");
        $("#" + id).find("ul").hide();
        $("#" + id).find(".recomShow").hide();
        $("#" + id).find("#" + rel).show();
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
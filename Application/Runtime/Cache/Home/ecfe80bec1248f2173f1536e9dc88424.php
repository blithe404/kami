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
            <div class="order-list">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="list-top">
                    <tbody>
                    <tr>
                        <td align="center" width="50%">商品信息</td>
                        <td align="center" width="10%">单价(元)</td>
                        <td align="center" width="5%">数量</td>
                        <td align="center" width="10%">实付款(元)</td>
                        <td align="center" width="10%">状态</td>
                    </tr>
                    </tbody>
                </table>
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="list-table">
                    <tbody>
                    <?php if(is_array($orders)): $i = 0; $__LIST__ = $orders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tr>
                            <td align="center" width="50%"><?php echo ($item["pname"]); ?></td>
                            <td align="center" width="10%"><?php echo ($item["price"]); ?></td>
                            <td align="center" width="5%"><?php echo ($item["number"]); ?></td>
                            <td align="center" width="10%"><?php echo ($item["total_price"]); ?></td>
                            <td align="center" width="10%">
                                <?php if(($item["status"]) == "0"): ?>待付款<?php endif; ?>
                                <?php if(($item["status"]) == "1"): ?>待发货<?php endif; ?>
                                <?php if(($item["status"]) == "2"): ?>已发货<?php endif; ?>
                                <?php if(($item["status"]) == "3"): ?>已取消<?php endif; ?>
                            </td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
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
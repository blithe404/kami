<?php
/**
 * Created by PhpStorm.
 * User: blirx
 * Date: 2018/1/11
 * Time: 17:28
 */

namespace Home\Controller;


class OrderController extends CommonController {

    public function create() {

        if(IS_POST) {
            $pid = I('post.pid', 0, 'intval');
            $number = I('post.number', 1, 'intval');
            $Order = D('Order');
            $res = $Order->createOrder(UID, $pid, $number);
            $this->ajaxReturn($res);
        }

        $pid = I('get.pid', 0, 'intval');
        $data = M('Product')->find($pid);

        $this->assign('data', $data);
        $this->assign('meta_title', '订单确认');
        $this->display();
    }
}
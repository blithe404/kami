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
            $email = I('post.email', '', 'trim');
            $Order = D('Order');
            $res = $Order->createOrder(UID, $pid, $number, $email);
            $this->ajaxReturn($res);
        }

        $pid = I('get.pid', 0, 'intval');
        $data = M('Product')->find($pid);
        $email = M('User')->where(array('id'=>UID))->getField('email');


        $this->assign('email', $email);
        $this->assign('data', $data);
        $this->assign('meta_title', '订单确认');
        $this->display();
    }

    public function pay() {

        $Order = D('Order');

        if(IS_POST) {
            $oid = I('post.oid', 0, 'intval');
            $res = $Order->pay(UID, $oid);
            $this->ajaxReturn($res);
        }

        $oid = I('get.oid', 0, 'intval');
        $data = $Order->find($oid);

        $this->assign('data', $data);
        $this->assign('meta_title', '订单支付');
        $this->display();

    }
}
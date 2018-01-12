<?php
/**
 * Created by PhpStorm.
 * User: blirx
 * Date: 2018/1/11
 * Time: 18:54
 */

namespace Home\Controller;


class PayOrderController extends CommonController {
    public function create() {

        $User = D('User');
        $Bank = D('Bank');
        $PayOrder = D('PayOrder');

        if(IS_POST) {
            $bank_id = I('post.bank_id', 0, 'intval');
            $money = I('post.money', '', 'trim');
            $paytime = I('post.paytime', '', 'trim');
            $remark = I('post.remark', '', 'trim');

            $res = $PayOrder->createOrder(UID, $bank_id, $money, $paytime, $remark);
            $this->ajaxReturn($res);
        }

        $is_bind = $User->isBind(UID);
        if(!$is_bind) $this->redirect('User/index');

        $this->assign('meta_title', '充值');
        $this->assign('banks', $Bank->getBanks());
        $this->display();
    }
}
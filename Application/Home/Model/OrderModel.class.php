<?php
/**
 * Created by PhpStorm.
 * User: blirx
 * Date: 2018/1/12
 * Time: 17:35
 */

namespace Home\Model;


class OrderModel extends CommonModel {
    public function createOrder($uid, $pid, $number, $email) {
        if ((int)$uid == 0)
            return $this->message(-10, '请先登录', U(C('LOGIN_URL')));
        if ((int)$pid == 0)
            return $this->message(0, '该商品不存在');
        if ((int)$number < 1)
            return $this->message(0, '请输入购买数量');
        if (empty($email))
            return $this->message(0, '请输入收货邮箱');

        $product = M('Product')->find($pid);
        if (empty($product))
            return $this->message(0, '该商品不存在');

        $bind_bank = M('User')->where(array('id' => $uid))->getField('bind_bank');
        if ((int)$bind_bank == 0)
            return $this->message(0, '请先实名认证', U('User/index'));

        $total_price = $product['price'] * $number;
        if (UBLANCE < $total_price)
            return $this->message(0, '站点余额不足，请先充值');

        $data = array(
            'uid'         => $uid,
            'pid'         => $pid,
            'pname'       => $product['name'],
            'price'       => $product['price'],
            'number'      => $number,
            'total_price' => $total_price,
            'email'       => $email,
            'datetime'    => time(),
            'updatetime'  => time()
        );
        $res = $this->add($data);
        if ((int)$res == 0) return $this->message(0, '提交失败');

        M('User')->where(array('id' => $uid))->setField('email', $email);

        return $this->message(1, '提交成功', U('Order/pay?oid=' . $res));

    }

    public function pay($uid, $oid) {
        if ((int)$oid == 0)
            return $this->message(0, '该订单不存在');
        if ((int)$uid == 0)
            return $this->message(-10, '请先登录', U(C('LOGIN_URL')));

        $omap['id'] = $oid;
        $omap['uid'] = $uid;
        $data = $this->where($omap)->find();
        if (empty($data))
            return $this->message(0, '该订单不存在');

        $this->where($omap)->setField('status', 1);
        M('User')->where(array('id' => $uid))->setDec('balance', $data['total_price']);
        return $this->message(1, '支付成功', U('User/orderList'));
    }
}
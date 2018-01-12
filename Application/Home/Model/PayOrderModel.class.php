<?php
/**
 * Created by PhpStorm.
 * User: blirx
 * Date: 2018/1/11
 * Time: 19:43
 */

namespace Home\Model;


class PayOrderModel extends CommonModel {

    public function createOrder($uid, $bank_id, $money, $paytime, $remark) {
        if ((int)$uid == 0)
            return $this->message(-10, '请先登录', U(C('LONGIN_URL')));
        if ((int)$bank_id == 0)
            return $this->message(0, '请选择汇款账户');
        if (!is_numeric($money))
            return $this->message(0, '汇款金额应为数字');
        $paytime = strtotime($paytime);
        if (!$paytime)
            return $this->message(0, '请选择汇款时间');

        $data = array(
            'uid'        => $uid,
            'bank_id'    => $bank_id,
            'money'      => $money,
            'paytime'    => $paytime,
            'remark'     => $remark,
            'datetime'   => time(),
            'updatetime' => time(),
        );
        $res = $this->add($data);
        if ((int)$res == 0)
            return $this->message(0, '提交失败');
        return $this->message(1, '提交成功', U(C('INDEX_URL')));
    }
}
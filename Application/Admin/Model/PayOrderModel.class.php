<?php
/**
 * Created by PhpStorm.
 * User: blirx
 * Date: 2018/1/12
 * Time: 19:45
 */

namespace Admin\Model;


class PayOrderModel extends CommonModel {
    public function verify($id) {
        if ((int)$id == 0)
            return $this->message(0, '该记录不存在');
        $order = $this->where(array('id' => $id))->field('uid,money')->find();

        $map['id'] = $order['uid'];
        $res = M('User')->where($map)->setInc('balance', $order['money']);
        if ($res === false)
            return $this->message(0, '余额充值失败，请手动修改');
        $this->where(array('id' => $id))->setField('status', 1);
        return $this->message(1, '提交成功');
    }

    public function errorOrder($id) {
        if ((int)$id == 0)
            return $this->message(0, '该记录不存在');
        $res = $this->where(array('id'=>$id))->setField('status', -1);
        if($res === false)
            return $this->message(0, '保存失败');
        return $this->message(0, '提交成功');
    }
}
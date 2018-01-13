<?php
/**
 * Created by PhpStorm.
 * User: blirx
 * Date: 2018/1/13
 * Time: 21:25
 */

namespace Admin\Model;


class OrderModel extends CommonModel {
    public function setStatus($id, $status = 0) {
        if((int)$id == 0)
            return $this->message(0, '该订单不存在');
        if(!in_array($status, array(1, 2)))
            return $this->message(0, '该状态不存在');
        $res = $this->where(array('id'=>$id))->setField('status', $status);
        if($res === false)
            return $this->message(0, '修改失败');
        return $this->message(1, '保存成功');
    }
}
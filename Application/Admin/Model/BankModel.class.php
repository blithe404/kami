<?php
/**
 * Created by PhpStorm.
 * User: blirx
 * Date: 2018/1/12
 * Time: 19:30
 */

namespace Admin\Model;


class BankModel extends CommonModel {
    protected $_validate = array(
        array('name', 'require', '请输入姓名！'),
        array('title', 'require', '请输入所属银行！'),
        array('card', 'require', '请输入卡号！'),
        array('card', '', '卡号已存在', 0, 'unique', 3),
    );

    public function addData() {
        if(!$this->create()) {
            return $this->message(0, $this->getError());
        } else {
            $res = $this->add();
            if((int)$res == 0) return $this->message(0, '添加失败');
            return $this->message(1, '添加成功');
        }
    }

    public function saveData() {
        if(!$this->create()) {
            return $this->message(0, $this->getError());
        } else {
            if(!empty($this->bankcard) && !empty($this->bank))
                $this->bind_bank = 1;
            $res = $this->save();
            if($res === false) return $this->message(0, '保存失败');
            return $this->message(1, '保存成功');
        }
    }

    public function deleteData($id) {
        if((int)$id == 0) return $this->message(0, '该记录不存在');
        $res = $this->delete($id);
        if((int)$res == 0) return $this->message(0, '删除失败');
        return $this->message(1, '删除成功');
    }
}
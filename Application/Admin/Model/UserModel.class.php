<?php
/**
 * Created by PhpStorm.
 * User: blirx
 * Date: 2018/1/12
 * Time: 01:33
 */

namespace Admin\Model;


class UserModel extends CommonModel {
    protected $_validate = array(
        array('username', 'require', '请输入用户名！'),
        array('email', 'require', '请输入邮箱！'),
        array('realname', 'require', '请输入姓名！'),
        array('idcard', 'require', '请输入身份证！'),
        array('password', 'require', '请输入密码！'),
        array('username', '', '用户名已存在', 0, 'unique', 3),
    );

    protected $_auto = array(
        array('ip', 'get_client_ip', 3, 'function'),
        array('datetime', 'time', 1, 'function'),
        array('updatetime', 'time', 2, 'function'),
        array('password', 'md5_password', 1, 'function'),
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
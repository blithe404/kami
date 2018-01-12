<?php
/**
 * Created by PhpStorm.
 * User: blirx
 * Date: 2018/1/13
 * Time: 03:14
 */

namespace Admin\Model;


class AdminModel extends CommonModel {

    public function changePwd($old_pwd, $new_pwd) {
        if (empty($old_pwd))
            return $this->message(0, '请输入原始密码');
        if (empty($new_pwd))
            return $this->message(0, '请输入新密码');

        $count = $this->where(array('id' => AID, 'password' => md5_password($old_pwd)))->count();
        if ((int)$count == 0)
            return $this->message(0, '原始密码错误');

        $res = $this->where(array('id' => AID))->setField('password', md5_password($new_pwd));
        if ($res === false)
            return $this->message(0, '修改失败');
        if ((int)$res == 0)
            return $this->message(0, '未做修改');
        return $this->message(1, '修改成功');
    }

    public function login($name, $password) {
        if (empty($name))
            return $this->message(0, '请输入用户名');
        if (empty($password))
            return $this->message(0, '请输入密码');
        $map = array(
            'name'     => $name,
            'password' => md5_password($password),
        );
        $data = $this->where($map)->find();
        if (empty($data))
            return $this->message(0, '用户名或密码错误');

        $this->where($map)->save(array(
            'ip'         => get_client_ip(),
            'updatetime' => time(),
        ));
        session('aid', $data['id']);
        session('aname', $name);
        return $this->message(1, '登录成功', U(C('INDEX_URL')));
    }
}
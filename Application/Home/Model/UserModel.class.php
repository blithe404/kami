<?php
/**
 * Created by PhpStorm.
 * User: blirx
 * Date: 2018/1/11
 * Time: 01:03
 */

namespace Home\Model;

class UserModel extends CommonModel {

    public function login($username, $password, $verify_code) {
        if (empty($username))
            return $this->message(0, '请输入用户名');
        if (empty($password))
            return $this->message(0, '请输入密码');
        if (!$this->check_verify($verify_code))
            return $this->message(-1, '验证码错误');

        $map = array(
            'username' => $username,
            'password' => md5(C('USER_KEY') . $password),
        );

        $data = $this->where($map)->find();
        if (empty($data)) return $this->message(-1, '用户名或密码错误');

        $this->setSession(array(
            'uname' => $data['username'],
            'uid'   => $data['id']
        ));

        $this->where(array('id' => $data['id']))->save(array(
            'ip'         => get_client_ip(),
            'updatetime' => time(),
        ));

        return $this->message(1, '登录成功', U(C('INDEX_URL')));
    }

    private function setSession($data) {
        foreach ($data as $key => $val) {
            session($key, $val);
        }
    }

    public function getData($id) {
        return $this->find($id);
    }

    public function changePwd($uid, $old_pwd, $new_pwd, $verify_pwd) {
        if ((int)$uid == 0)
            return $this->message(-10, '请先登录', U(C('LOGIN_URL')));

        $user_pwd = $this->where(array('id' => $uid))->getField('password');
        if ($user_pwd != md5(C('USER_KEY') . $old_pwd))
            return $this->message(0, '原密码错误');

        if (empty($new_pwd))
            return $this->message(0, '请填写新密码');
        if (empty($verify_pwd))
            return $this->message(0, '请确认密码');
        if ($new_pwd !== $verify_pwd)
            return $this->message(0, '密码不一致');

        $res = $this->where(array('id' => $uid))->save(array(
            'password' => md5(C('USER_KEY') . $new_pwd)
        ));
        if ($res === false)
            return $this->message(0, '保存失败');
        return $this->message(1, '保存成功', U('User/index'));
    }

    public function isBind($uid) {
        $bind_bank = $this->where(array('id' => $uid))->getField('bind_bank');
        if ((int)$bind_bank == 0)
            return false;
        return true;
    }

    public function saveInfo($uid, $email, $realname, $idcard, $idcard_img, $bank, $bankcard) {
        if ((int)$uid == 0)
            return $this->message(0, '请重新登录', U(C('LOGIN_URL')));
        if (empty($email))
            return $this->message(0, '请填写电子邮箱');
        if (empty($realname))
            return $this->message(0, '请填写姓名');
        if (empty($idcard))
            return $this->message(0, '请输入身份证');
        if (!in_array(strlen($idcard), array(15, 18)))
            return $this->message(0, '身份证格式错误');
        if (empty($bankcard))
            return $this->message(0, '请填写银行卡号');
        if (empty($bank))
            return $this->message(0, '请填写所属银行');
        if (empty($idcard_img))
            return $this->message(0, '请上传证件照');

        if($this->isBind($uid))
            return $this->message(0, '已经绑定');

        $map['id'] = $uid;
        $data = array(
            'email'      => $email,
            'realname'   => $realname,
            'idcard'     => $idcard,
            'bank'       => $bank,
            'bankcard'   => $bankcard,
            'idcard_img' => $idcard_img,
            'bind_bank'  => 1,
        );
        $res = $this->where($map)->save($data);
        if ($res === false) return $this->message(0, '保存失败');
        return $this->message(1, '保存成功');
    }


    public function register($username, $email, $realname, $idcard, $password, $verify_password, $verify_code) {
        if (empty($username))
            return $this->message(0, '请输入用户名');
        if (empty($email))
            return $this->message(0, '请输入电子邮箱');
        if (empty($realname))
            return $this->message(0, '请输入真实姓名');
        if (empty($idcard))
            return $this->message(0, '请输入身份证');
        if (!in_array(strlen($idcard), array(15, 18)))
            return $this->message(0, '身份证格式错误');
        if (!is_numeric($idcard))
            return $this->message(0, '身份证格式错误');
        if (empty($password))
            return $this->message(0, '请输入密码');
        if (empty($verify_password))
            return $this->message(0, '请确认密码');
        if ($password !== $verify_password)
            return $this->message(0, '密码不一致');
        if (!$this->check_verify($verify_code))
            return $this->message(-1, '验证码错误');

        $data = array(
            'username'   => $username,
            'email'      => $email,
            'realname'   => $realname,
            'idcard'     => $idcard,
            'password'   => md5(C('USER_KEY') . $password),
            'datetime'   => time(),
            'updatetime' => time(),
            'ip'         => get_client_ip(),
        );

        $res = $this->add($data);

        if ((int)$res == 0) return $this->message(-1, '注册失败，请联系客服');

        $this->setSession(array(
            'uname' => $username,
            'uid'   => $res
        ));

        return $this->message(1, '注册成功', U(C('INDEX_URL')));
    }
}
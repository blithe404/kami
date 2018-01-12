<?php
/**
 * Created by PhpStorm.
 * User: blirx
 * Date: 2018/1/10
 * Time: 05:21
 */

namespace Home\Controller;


class UserController extends CommonController {
    public function login() {
        if (IS_POST) {
            $username = I('post.username', '', 'trim');
            $password = I('post.password', '', 'trim');
            $verify_code = I('post.verify_code', '', 'trim');
            $User = D('User');
            $res = $User->login($username, $password, $verify_code);
            $this->ajaxReturn($res);
        }
        $this->assign('meta_title', '会员登录');
        $this->display();
    }


    public function register() {
        if (IS_POST) {
            $username = I('post.username', '', 'trim');
            $email = I('post.email', '', 'trim');
            $realname = I('post.realname', '', 'trim');
            $idcard = I('post.idcard', '', 'trim');
            $password = I('post.password', '', 'trim');
            $verify_password = I('post.verify_password', '', 'trim');
            $verify_code = I('post.verify_code', '', 'trim');
            $User = D('User');
            $res = $User->register($username, $email, $realname, $idcard, $password, $verify_password, $verify_code);
            $this->ajaxReturn($res);
        }
        $this->assign('meta_title', '会员注册');
        $this->display();
    }

    public function logout() {
        session('uid', null);
        session('uname', null);
        session('urealname', null);
        session('uemail', null);
        session('uidcard', null);
        $this->redirect(C('INDEX_URL'));
    }

    public function changePwd() {
        if (IS_POST) {
            $User = D('User');
            $old_pwd = I('post.old_pwd');
            $new_pwd = I('post.new_pwd');
            $verify_pwd = I('post.verify_pwd');
            $res = $User->changePwd(UID, $old_pwd, $new_pwd, $verify_pwd);
            $this->ajaxReturn($res);
        }
        $this->assign('meta_title', '修改密码');
        $this->display('change_pwd');
    }

    public function index() {

        $User = D('User');

        if (IS_POST) {
            $email = I('post.email', '', 'trim');
            $realname = I('post.realname', '', 'trim');
            $idcard = I('post.idcard', '', 'trim');
            $bankcard = I('post.bankcard', '', 'trim');
            $bank = I('post.bank', '', 'trim');
            $idcard_img = I('post.idcard_img', '', 'trim');
            $res = $User->saveInfo(UID, $email, $realname, $idcard, $idcard_img, $bank, $bankcard);
            $this->ajaxReturn($res);
        }

        $data = $User->getData(UID);

        $this->assign('data', $data);
        $this->assign('meta_title', '会员中心');
        $this->display();
    }

    public function orderList() {
        $User = D('User');
        $data = $User->getData(UID);
        $orders = M('Order')->where(array('uid'=>UID))->order('datetime desc')->select();

        $this->assign('orders', $orders);
        $this->assign('data', $data);
        $this->assign('meta_title', '我的订单');
        $this->display();
    }

    public function imgVerify() {
        $Verify = new \Think\Verify(array(
            'useCurve' => false,
            'useNoise' => false,
            'length'   => 4,
            'codeSet'  => '0123456789',
            'fontSize' => 30,
        ));
        $Verify->entry();
    }
}
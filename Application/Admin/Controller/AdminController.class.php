<?php
/**
 * Created by PhpStorm.
 * User: blirx
 * Date: 2018/1/13
 * Time: 03:14
 */

namespace Admin\Controller;


class AdminController extends CommonController {
    public function login() {
        if(IS_POST) {
            $name = I('post.name', '', 'trim');
            $password = I('post.password', '', 'trim');
            $res = D('Admin')->login($name, $password);
            $this->ajaxReturn($res);
        }
        $this->assign('meta_title', '后台登录');
        $this->display();
    }

    public function changePwd() {
        if(IS_POST) {
            $old_pwd = I('post.old_pwd', '', 'trim');
            $new_pwd = I('post.new_pwd', '', 'trim');
            $res = D('Admin')->changePwd($old_pwd, $new_pwd);
            $this->ajaxReturn($res);
        }
        $this->ajaxReturn($this->fetch('pwd'));
    }

    public function logout() {
        session('aid', null);
        session('aname', null);
        $res = array(
            'url' => U(C('LOGIN_URL'))
        );
        $this->ajaxReturn($res);
    }
}
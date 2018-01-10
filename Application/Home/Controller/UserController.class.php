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
        $this->assign('meta_title', '会员登录');
        $this->display();
    }

    public function imgVerify() {
        $Verify = new \Think\Verify(array(
            'useCurve' => false,
            'useNoise' => false,
            'length' => 4,
            'codeSet' => '0123456789',
            'fontSize' => 30,
        ));
        $Verify->entry();
    }
}
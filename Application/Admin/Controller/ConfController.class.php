<?php
/**
 * Created by PhpStorm.
 * User: blirx
 * Date: 2018/1/13
 * Time: 02:55
 */

namespace Admin\Controller;


class ConfController extends CommonController {
    public function index() {
        if(IS_POST) {
            $res = D('Conf')->saveConf(I('post.'));
            $this->ajaxReturn($res);
        }

        $field = M('Conf')->select();
        $this->assign('field', $field);
        $this->ajaxReturn($this->fetch());
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: blirx
 * Date: 2018/1/10
 * Time: 02:14
 */

namespace Home\Controller;


use Think\Controller;

class CommonController extends Controller {

    protected function _initialize() {
        $this->_isLogin();
        $this->_confs();
        $this->_balance();
    }

    protected function _confs() {
        $confs = D('Conf')->getConfs();
        $this->assign('confs', $confs);
    }

    protected function _balance() {
        $balance = M('User')->where(array('id' => UID))->getField('balance');
        define('UBLANCE', $balance);
    }

    protected function _isLogin() {
        $allows = array(
            'user'    => 'login,logout,register,imgverify',
            'index'   => 'index',
            'product' => 'lists',
        );
        $controller = strtolower(CONTROLLER_NAME);
        $action = strtolower(ACTION_NAME);

        define('UID', session('uid'));
        define('UNAME', session('uname'));

        if (isset($allows[$controller])) {
            if ($allows[$controller] == '*')
                return true;
            $actions = explode(',', $allows[$controller]);
            if (in_array($action, $actions))
                return true;
        }
        if ((int)UID == 0) {
            $this->redirect(C('LOGIN_URL'));
        }
    }

    protected function display($templateFile = '') {
        $theme = 'pc';
        $this->theme($theme);
        parent::display($templateFile);
    }
}
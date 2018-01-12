<?php
/**
 * Created by PhpStorm.
 * User: blirx
 * Date: 2018/1/11
 * Time: 22:07
 */

namespace Admin\Controller;


use Think\Controller;

class CommonController extends Controller {

    protected function _initialize() {
        $this->_isLogin();
    }

    protected function _isLogin() {
        $allows = array(
            'admin' => 'login'
        );
        $controller = strtolower(CONTROLLER_NAME);
        $action = strtolower(ACTION_NAME);

        define('AID', session('aid'));
        define('ANAME', session('aname'));

        if (isset($allows[$controller])) {
            if ($allows[$controller] == '*')
                return true;
            $actions = explode(',', $allows[$controller]);
            if (in_array($action, $actions))
                return true;
        }
        if ((int)AID == 0) {
            $this->redirect(C('LOGIN_URL'));
        }
    }

    protected function getListByAjax($setting) {
        if(empty($setting['table'])) return null;
        $model = M();
        $table = !empty($setting['table']) ? $setting['table'] : '';
        $field = !empty($setting['field']) ? $setting['field'] : true;
        $where = !empty($setting['where']) ? $setting['where'] : array();
        $order = !empty($setting['order']) ? $setting['order'] : '';
        $limit = !empty($setting['limit']) ? $setting['limit'] : 10;

        if(is_array($table)) {
            foreach ($table as $key => $val) {
                $k = C('DB_PREFIX').$key;
                $k = strtolower($k);
                $tables[$k] = $val;
            }
        } else {
            $table = strtolower($table);
            $tables = C('DB_PREFIX').$table;
        }

        $count = $model->table($tables)->where($where)->count();
        $page = new \Org\Util\Page($count, $limit);
        $list = $model->table($tables)->where($where)->order($order)->field($field)->limit($page->firstRow . ',' . $page->listRows)->select();

        if((int)$count == 0) {
            return array('code' => -1, 'msg' => '没有相关记录');
        }
        $res = array(
            'code' => 0,
            'msg' => '',
            'count' => $count,
            'data' => $list
        );
        return $res;
    }
}
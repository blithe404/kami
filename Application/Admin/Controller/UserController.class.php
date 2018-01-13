<?php
/**
 * Created by PhpStorm.
 * User: blirx
 * Date: 2018/1/11
 * Time: 23:32
 */

namespace Admin\Controller;


class UserController extends CommonController {

    private $model = 'User';
    private $table = 'User';

    public function index() {
        $this->assign('keyword', '用户');
        $this->ajaxReturn($this->fetch());
    }

    public function order() {
        $this->assign('keyword', '用户');
        $this->ajaxReturn($this->fetch());
    }

    public function lists() {
        if (IS_AJAX) {
            $res = $this->getListByAjax(array(
                'table' => $this->table,
                'limit' => I('get.limit', 10, 'intval')
            ));
            $this->ajaxReturn($res);
        }
    }

    public function order_lists() {
        if (IS_AJAX) {
            $table = array(
                'Order' => 'o',
                'User' => 'u'
            );
            $field = 'o.id,o.pname,o.price,o.number,o.total_price,o.datetime,o.status,u.username';
            $map['o.uid'] = array('exp', '=u.id');
            $res = $this->getListByAjax(array(
                'table' => $table,
                'where' => $map,
                'field' => $field,
                'limit' => I('get.limit', 10, 'intval')
            ));
            $this->ajaxReturn($res);
        }
    }

    public function add() {

        if(IS_POST) {
            $Model = D($this->model);
            $res = $Model->addData();
            $this->ajaxReturn($res);
        }

        $this->assign('keyword', '用户');
        $this->ajaxReturn($this->fetch());
    }

    public function edit() {
        $Model = D($this->model);

        if(IS_POST) {
            $res = $Model->saveData();
            $this->ajaxReturn($res);
        }

        $id = I('get.id', 0, 'intval');
        $data = $Model->find($id);
        $this->assign('data', $data);
        $this->ajaxReturn($this->fetch());
    }

    public function delete() {
        if(IS_POST) {
            $id = I('post.id', 0, 'intval');
            $Model = D($this->model);
            $res = $Model->deleteData($id);
            $this->ajaxReturn($res);
        }

    }

    public function search() {
        if (IS_AJAX) {
            $keyword = I('get.keyword', '', 'trim');
            $map = array(
                'username' => array('like', '%' . $keyword . '%')
            );
            $res = $this->getListByAjax(array(
                'table' => $this->table,
                'where' => $map,
                'limit' => I('get.limit', 10, 'intval')
            ));
            $this->ajaxReturn($res);
        }
    }

    public function order_search() {
        if (IS_AJAX) {
            $keyword = I('get.keyword', '', 'trim');
            $table = array(
                'Order' => 'o',
                'User' => 'u'
            );
            $field = 'o.id,o.pname,o.price,o.number,o.total_price,o.datetime,u.username';
            $map['o.uid'] = array('exp', '=u.id');
            $map['u.username'] = array('like', '%' . $keyword . '%');
            $res = $this->getListByAjax(array(
                'table' => $table,
                'where' => $map,
                'field' => $field,
                'limit' => I('get.limit', 10, 'intval')
            ));
            $this->ajaxReturn($res);
        }
    }

    public function setOrderStatus() {
        if (IS_POST) {
            $id = I('post.id', 0, 'intval');
            $status = I('post.status', 0, 'intval');
            $res = D('Order')->setStatus($id, $status);
            $this->ajaxReturn($res);
        }
    }
}
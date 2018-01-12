<?php
/**
 * Created by PhpStorm.
 * User: blirx
 * Date: 2018/1/12
 * Time: 19:22
 */

namespace Admin\Controller;


class BankController extends CommonController {
    private $model = 'Bank';
    private $table = 'Bank';

    public function index() {
        $this->assign('keyword', '账户');
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
        $this->ajaxReturn($this->fetch('add'));
    }

    public function delete() {
        if(IS_POST) {
            $id = I('post.id', 0, 'intval');
            $Model = D($this->model);
            $res = $Model->deleteData($id);
            $this->ajaxReturn($res);
        }

    }
}
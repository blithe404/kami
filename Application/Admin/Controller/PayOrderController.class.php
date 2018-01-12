<?php
/**
 * Created by PhpStorm.
 * User: blirx
 * Date: 2018/1/12
 * Time: 19:36
 */

namespace Admin\Controller;


class PayOrderController extends CommonController {

    private $model = 'PayOrder';
    private $table = array(
        'Pay_Order' => 'po',
        'User'      => 'u',
        'Bank'      => 'b',
    );

    public function index() {
        $this->assign('keyword', '用户名');
        $this->ajaxReturn($this->fetch());
    }

    public function lists() {
        if (IS_AJAX) {
            $map = array(
                'po.uid'     => array('exp', '=u.id'),
                'po.bank_id' => array('exp', '=b.id')
            );
            $res = $this->getListByAjax(array(
                'table' => $this->table,
                'where' => $map,
                'field' => 'po.id,po.money,po.paytime,po.remark,po.status,po.datetime,u.username,u.bankcard,u.realname,b.card,b.name',
                'limit' => I('get.limit', 10, 'intval'),
                'order' => 'po.status asc,po.datetime asc'
            ));
            $this->ajaxReturn($res);
        }
    }

    public function verify() {
        if(IS_POST) {
            $id = I('post.id', 0, 'intval');
            $Model = D($this->model);
            $res = $Model->verify($id);
            $this->ajaxReturn($res);
        }
    }

    public function search() {
        if (IS_AJAX) {
            $keyword = I('get.keyword', '', 'trim');
            $map = array(
                'po.uid'     => array('exp', '=u.id'),
                'po.bank_id' => array('exp', '=b.id'),
                'u.username' => array('like', '%' . $keyword . '%'),
            );
            $res = $this->getListByAjax(array(
                'table' => $this->table,
                'where' => $map,
                'field' => 'po.id,po.money,po.paytime,po.remark,po.status,po.datetime,u.username,u.bankcard,u.realname,b.card,b.name',
                'limit' => I('get.limit', 10, 'intval'),
                'order' => 'po.status asc,po.datetime asc'
            ));
            $this->ajaxReturn($res);
        }
    }
}
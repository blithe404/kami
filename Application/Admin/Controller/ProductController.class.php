<?php
/**
 * Created by PhpStorm.
 * User: blirx
 * Date: 2018/1/12
 * Time: 13:43
 */

namespace Admin\Controller;


class ProductController extends CommonController {
    private $model = 'Product';
    private $table = array('Product' => 'p', 'Product_Category' => 'pc');

    public function index() {
        $this->assign('keyword', '商品');
        $this->ajaxReturn($this->fetch());
    }

    public function lists() {
        if (IS_AJAX) {
            $res = $this->getListByAjax(array(
                'table' => $this->table,
                'where' => array(
                    'p.cid' => array('exp', '=pc.id')
                ),
                'field' => 'p.id,p.cid,p.name,p.sale,p.price,p.img,pc.name as cname',
                'limit' => I('get.limit', 10, 'intval')
            ));
            $this->ajaxReturn($res);
        }
    }

    public function add() {
        if (IS_POST) {
            $Model = D($this->model);
            $res = $Model->addData();
            $this->ajaxReturn($res);
        }
        $category = M('ProductCategory')->order('sort asc')->select();
        $this->assign('category', $category);
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
        $category = M('ProductCategory')->order('sort asc')->select();
        $this->assign('category', $category);
        $this->assign('data', $data);
        $this->ajaxReturn($this->fetch('add'));
    }

    public function delete() {
        if (IS_POST) {
            $id = I('post.id', 0, 'intval');
            $Model = D($this->model);
            $res = $Model->deleteData($id);
            $this->ajaxReturn($res);
        }

    }

    public function search() {
        if (IS_AJAX) {
            $keyword = I('get.keyword', '', 'trim');
            $res = $this->getListByAjax(array(
                'table' => $this->table,
                'where' => array(
                    'p.cid' => array('exp', '=pc.id'),
                    'name' => array('like', '%' . $keyword . '%')
                ),
                'field' => 'p.id,p.cid,p.name,p.sale,p.price,p.img,pc.name as cname',
                'limit' => I('get.limit', 10, 'intval')
            ));
            $this->ajaxReturn($res);
        }
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: blirx
 * Date: 2018/1/12
 * Time: 13:45
 */

namespace Admin\Controller;


class ProductCategoryController extends CommonController {

    private $model = 'ProductCategory';
    private $table = 'Product_Category';

    public function index() {
        $this->assign('keyword', '分类');
        $this->ajaxReturn($this->fetch());
    }

    public function lists() {
        if (IS_AJAX) {
            $res = $this->getListByAjax(array(
                'table' => $this->table,
                'order' => 'sort asc',
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
        $this->ajaxReturn($this->fetch());
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
            $map = array(
                'name' => array('like', '%' . $keyword . '%')
            );
            $res = $this->getListByAjax(array(
                'table' => $this->table,
                'where' => $map,
                'limit' => I('get.limit', 10, 'intval')
            ));
            $this->ajaxReturn($res);
        }
    }

    public function sort() {
        $id = I('post.id', 0, 'intval');
        $sort = I('post.sort', 1, 'intval');
        $Model = D($this->model);
        $res = $Model->sort($id, $sort);
        $this->ajaxReturn($res);
    }
}
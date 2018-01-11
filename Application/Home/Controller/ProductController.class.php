<?php
/**
 * Created by PhpStorm.
 * User: blirx
 * Date: 2018/1/11
 * Time: 20:47
 */

namespace Home\Controller;


class ProductController extends CommonController {
    public function lists() {

        $this->assign('meta_title', '商品列表');
        $this->display();
    }
}
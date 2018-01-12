<?php
namespace Home\Controller;
class IndexController extends CommonController {

    public function index() {

        $Product = D('Product');
        $category = M('ProductCategory')->order('sort asc')->select();
        $category_product = $Product->getCategoryProduct();

        $this->assign('category', $category);
        $this->assign('category_product', $category_product);
        $this->assign('meta_title', '首页');
        $this->display();
    }
}
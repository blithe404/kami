<?php
namespace Home\Controller;
class IndexController extends CommonController {

    public function index() {

        $this->assign('meta_title', '首页');
        $this->display();
    }
}
<?php
namespace Admin\Controller;
class IndexController extends CommonController {

    public function index() {

        $this->assign('meta_title', '控制台');
        $this->display();
    }
}
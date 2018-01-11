<?php
/**
 * Created by PhpStorm.
 * User: blirx
 * Date: 2018/1/11
 * Time: 17:28
 */

namespace Home\Controller;


class OrderController extends CommonController {

    public function create() {

        $this->assign('meta_title', '订单确认');
        $this->display();
    }
}
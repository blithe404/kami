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

        $cid = I('get.cid', 1, 'intval');
        $map['cid'] = $cid;
        $map['p.cid'] = array('exp', '=pc.id');
        $table = array(
            'k_product' => 'p',
            'k_product_category' => 'pc'
        );
        $field = 'p.id,p.name,p.sale,p.price,p.img,pc.name as cname';
        $order = 'p.sale desc';
        $list = M()->table($table)->where($map)->field($field)->order($order)->select();

        $this->assign('list', $list);
        $this->assign('meta_title', '商品列表');
        $this->display();
    }
}
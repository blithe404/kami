<?php
/**
 * Created by PhpStorm.
 * User: blirx
 * Date: 2018/1/12
 * Time: 16:58
 */

namespace Home\Model;


class ProductModel extends CommonModel {
    public function getCategoryProduct() {
        $table = array(
            'k_product' => 'p',
            'k_product_category' => 'pc'
        );
        $field = 'p.id,p.name,pc.name as cname';
        $map = array(
            'p.cid' => array('exp', '=pc.id')
        );
        $order = 'pc.sort asc';
        $list = $this->table($table)->where($map)->field($field)->order($order)->select();
        foreach ($list as $item) {
            $cat = $item['cname'];
            unset($item['cname']);
            $res[$cat][] = $item;
        }
        return $res;
    }
}
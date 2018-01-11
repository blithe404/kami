<?php
/**
 * Created by PhpStorm.
 * User: blirx
 * Date: 2018/1/11
 * Time: 01:03
 */

namespace Home\Model;


use Think\Model;

class CommonModel extends Model {
    protected function check_verify($code, $id = '') {
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }

    protected function message($code = 0, $info = '', $url = '') {
        return array(
            'status' => $code,
            'info'   => $info,
            'url'    => $url
        );
    }

}
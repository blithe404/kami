<?php
namespace Admin\Model;
use Think\Model;

class CommonModel extends Model{

    protected function message($code = 0, $info = '提交失败', $url) {
        $data = array(
            'status' => $code,
            'info' => $info,
            'url' => $url,
        );
        return $data;
    }

}
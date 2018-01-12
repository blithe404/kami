<?php
/**
 * Created by PhpStorm.
 * User: blirx
 * Date: 2018/1/13
 * Time: 02:56
 */

namespace Admin\Model;


class ConfModel extends CommonModel {
    public function saveConf($data) {
        foreach ($data as $name => $value) {
            $res = $this->where(array('title'=>$name))->setField('value', $value);
            if($res === false)
                return $this->message(0, '保存失败');
        }
        return $this->message(1, '保存成功');
    }
}
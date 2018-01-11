<?php
/**
 * Created by PhpStorm.
 * User: blirx
 * Date: 2018/1/11
 * Time: 04:18
 */

namespace Home\Model;


class ConfModel extends CommonModel {
    public function getConfs() {
        return $this->getField('title,value', true);

    }
}
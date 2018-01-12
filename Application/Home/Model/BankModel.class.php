<?php
/**
 * Created by PhpStorm.
 * User: blirx
 * Date: 2018/1/11
 * Time: 19:32
 */

namespace Home\Model;


class BankModel extends CommonModel {
    public function getBanks() {
        return $this->select();
    }
}